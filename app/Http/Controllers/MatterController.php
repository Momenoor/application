<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Exports\MattersExport;
use App\Models\Cash;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
use App\Services\ClaimsService;
use App\Services\MatterService;
use Illuminate\Http\Request;


class MatterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MatterDataTable $dataTable)
    {

        abort_unless(auth()->user()->canAny(['matter-view', 'matter-only-own-view']), '403');

        return $dataTable->render('pages.matters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(auth()->user()->can('matter-create'), '403');
        return view('pages.matters.form.create');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\matter $matter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Matter $matter)
    {

        abort_unless(auth()->user()->canAny(['matter-view', 'matter-only-own-view']), '403');

        if (auth()->user()->can('matter-only-own-view') && auth()->user()->cannot('matter-view') && (!$matter->assistants->contains('id', auth()->user()->expert->id) && $matter->expert_id != auth()->user()->expert->id)) {
            abort('403');
        }


        $parties = MatterService::partiesResolve($matter);
        $claims = ClaimsService::make($matter)->getClaims();
        $source = 'show';
        return view('pages.matters.show', compact('matter', 'parties', 'source', 'claims'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Matter $matter)
    {
        abort_unless(auth()->user()->can('matter-edit'), '403');
        /*         if ($matter->isSubmitted()) {
                    return $this->show($matter);
                } */
        $claimsTypes = config('system.claims.types');
        $partiesTypes = config('system.parties.type');
        $parties = MatterService::partiesResolve($matter);
        $assistants = Expert::whereIn('category', ['certified', 'assistant'])->get();
        $subParties = Party::whereIn('type', ['office', 'advocate', 'advisor'])->get(['id', 'name']);
        $claims = ClaimsService::make($matter)->getClaims();
        $courtsList = Court::all();
        $levelList = config('system.level');
        $typesList = Type::all();
        $source = 'edit';
        return view('pages.matters.edit', compact('matter', 'parties', 'claimsTypes', 'partiesTypes', 'subParties', 'assistants', 'source', 'claims', 'courtsList', 'levelList', 'typesList'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Matter $matter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matter $matter)
    {
        abort_unless(auth()->user()->can('matter-delete'), '403');
        $matter->delete();
        return redirect(route('matter.index'))->withToastSuccess(__('app.matter_successfully_deleted'));
    }

    public function changeStatus(Matter $matter, $status)
    {
        abort_unless(auth()->user()->can('matter-change-status'), '403');
        $statuses = config('system.matter.status');
        if (!is_null($status)) {
            if (key_exists($status, $statuses)) {
                $matter->status = $status;
                $matter->{$status . '_date'} = now();
                $matter->procedures()->where('type', $status . '_date')->delete();
                $matter->procedures()->create([
                    'type' => $status . '_date',
                    'datetime' => now(),
                    'description' => __($status . '_date'),

                ]);
                $matter->save();
                return redirect()->to(url()->previous())->withToastSuccess(__('app.matter-status-changed-successfuly'));
            }
            return redirect()->to(url()->previous())->withToastError(__('app.matter-status-cannot-be-changed'));
        }

        return redirect()->to(url()->previous())->withToastError(__('app.matter-status-cannot-be-changed'));
    }

    public function exportFilterForm()
    {
        abort_unless(auth()->user()->can('matter-export'), '403');
        list($experts, $assistants, $types, $courts, $claimsStatus) = $this->getExperts();
        return view('pages.matters.export.filter', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus'));
    }

    public function export(Request $request)
    {
        abort_unless(auth()->user()->can('matter-export'), '403');
        $result = (new MatterService())->setFilters($request)->getForExcel();
        list($experts, $assistants, $types, $courts, $claimsStatus) = $this->getExperts();

        /*return view('pages.matters.export.filter', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus', 'result')); */
        return (new MattersExport($request))->download('matters-' . now() . '.xlsx');
    }

    public function partyUnlink(Matter $matter, $party, Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:expert,party',
        ]);
        $type = data_get($validated, 'type');
        $type = \Str::plural($type, 2);
        $matter->{$type}()->detach($party);
        return redirect(url()->previous())->withToastSuccess(__('app.party-deleted-successfully'));
    }

    public function distributing()
    {
        $last_activity_start_date = now()->subMonth(1)->day(config('system.last_activity.start_day'))->format('Y/m/d');
        $countCurrent = Matter::Current()->count();
        $assistants = Expert::assistantsList()
            ->active()
            ->withCount(['asAssistant as current_count' => function ($query) {
                return $query->current();
            }])
            ->withCount(['asAssistantAsFinished as finished_count' => function ($query) {
                return $query->where('reported_date', '>=', now()->subMonth(1))->where('reported_date', '<=', now());
            }])
            ->with('asAssistantAsFinished', function ($query) {
                return $query->where('reported_date', '>=', now()->subMonth(1))->where('reported_date', '<=', now())->with('claims');
            })
            ->with('asAssistant', function ($query) {
                return $query->where('matters.status', 'current')->with(['court', 'type', 'claims']);
            })
            ->with('matters', function ($query) {
                return $query->current()->with(['court', 'type', 'claims']);
            })
            ->with('asAssistantLastActivityMonth', function ($query) {
                return $query->with('claims');
            })
            ->withCount('asAssistantLastActivityMonth as last_activity_count')
            ->get();
        return view('pages.matters.distributing', compact('assistants', 'last_activity_start_date', 'countCurrent'));
    }

    public function updateBasicDate(Matter $matter, Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|min:4|max:4|date_format:Y',
            'number' => 'required',
            'court_id' => 'required|exists:courts,id',
            'level_id' => 'required',
            'type_id' => 'required|exists:types,id',
        ]);
        $matter->fill($validated);
        $matter->save();
        return redirect(url()->previous())->withToastSuccess(__('app.record-updated-successfully'));
    }

    /**
     * @return array
     */
    private function getExperts(): array
    {
        $experts = Expert::join('accounts', 'accounts.id', 'experts.account_id')->whereIn('category', [Expert::MAIN, Expert::CERTIFIED])->pluck('accounts.name', 'experts.id');
        $assistants = Expert::join('accounts', 'accounts.id', 'experts.account_id')->whereIn('category', [Expert::MAIN, Expert::CERTIFIED, Expert::ASSISTANT])->pluck('accounts.name', 'experts.id');
        $types = Type::pluck('name', 'id');
        $courts = Court::pluck('name', 'id');
        $claimsStatus = [
            Cash::OVERPAID,
            Cash::PAID,
            Cash::UNPAID,
            Cash::PARTIAL,
        ];
        return array($experts, $assistants, $types, $courts, $claimsStatus);
    }
}
