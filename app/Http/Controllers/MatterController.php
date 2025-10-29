<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Enums\RequestTypeEnum;
use App\Exports\MattersExport;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
use App\Services\ClaimsService;
use App\Services\Common;
use App\Services\MatterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class MatterController extends Controller
{

    public function __construct(private readonly Common $common)
    {
    }

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
        $matters = Matter::all();
        $requests = $matter->requests;
        return view('pages.matters.edit', compact('matter', 'parties', 'claimsTypes', 'partiesTypes', 'subParties', 'assistants', 'source', 'claims', 'courtsList', 'levelList', 'typesList', 'matters', 'requests'));
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
        // Authorization Check
        Gate::authorize('matter-change-status');

        $statuses = config('system.matter.status');

        if (!is_null($status) && key_exists($status, $statuses)) {

            // Check Permissions for Status Change
            abort_unless($statuses[$status]['index'] >= $statuses[$matter->status]['index'] || auth()->user()->can('matter-change-status-back'), 403);

            // Update Matter Status and Related Information
            $matter->status = $status;
            if ($status == 'current') {
                foreach ($statuses as $key => $value) {
                    if ($matter->{$key . '_date'}) {
                        $matter->{$key . '_date'} = null;
                    }
                }
                $matter->procedures()->delete();
            } else {
                $matter->{$status . '_date'} = now();
                $matter->procedures()->updateOrCreate(
                    ['type' => $status . '_date'],
                    [
                        'datetime' => now(),
                        'description' => __($status . '_date'),
                    ]
                );
            }

            $matter->save();

            return redirect()->to(url()->previous())->withToastSuccess(__('app.matter-status-changed-successfuly'));
        }

        return redirect()->to(url()->previous())->withToastError(__('app.matter-status-cannot-be-changed'));
    }

    public function exportFilterForm()
    {
        abort_unless(auth()->user()->can('matter-export'), '403');
        list($experts, $assistants, $types, $courts, $claimsStatus) = $this->common->fetchDataForForm();
        return view('pages.matters.export.filter', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus'));
    }
    private function buildCombinedRows(Request $request): array
    {
        // 1) fetch select lists (assistant id=>name used for display)
        [, $assistants] = $this->common->fetchDataForForm(); // [experts, assistants, types, courts, claimsStatus]

        // 2) get matters as shown in the view, with eager loads for display columns
        $matters = (new MatterService())
            ->setFilters($request)
            ->getForExcel()
            ->with(['expert', 'court', 'type', 'claimsWithOutVat'])  // <- important
            ->get();

        $matterById   = $matters->keyBy('id');
        $matterIds    = $matters->pluck('id')->all();

        // 3) date window
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date',   now()->endOfMonth()->toDateString());

        // 4) new per-assistant rows (from your trait)
        $summary = collect(Matter::getCommissionSummaryByPeriod($startDate, $endDate))
            ->whereIn('case_id', $matterIds)
            ->sortBy('assistant_id')     // or sort by name using $assistants map
            ->values();

        // 5) if any case_ids are missing from lookup, backfill (safety)
        $missingIds = $summary->pluck('case_id')->unique()->diff($matterById->keys());
        if ($missingIds->isNotEmpty()) {
            $extra = Matter::with(['expert', 'court', 'type', 'claimsWithOutVat'])
                ->whereIn('id', $missingIds)->get()->keyBy('id');
            $matterById = $matterById->merge($extra);
        }

        $wantCommissionCols = $request->input('for_commission') === 'yes';

        // 6) build the final combined rows (ASSOCIATIVE arrays with headings you want)
        $rows = $summary->map(function (array $row) use ($matterById, $assistants, $wantCommissionCols) {
            $m = $matterById->get($row['case_id']);

            $assistantName = !empty($row['assistant_id'])
                ? ($assistants[$row['assistant_id']] ?? $row['assistant_id'])
                : null;

            $claimAmount = $m ? $m->claimsWithOutVat->sum('amount') : 0;

            // legacy / old columns you used to export (add/remove to taste)
            $base = [
                'No'                 => $m?->number ?? $row['case_id'],
                'Year'               => $m?->year,
                'Expert'             => $m?->expert?->name,
                'Court'              => $m?->court?->name,
                'Type'               => $m?->type?->name,
                'Assistant'          => $assistantName,
                'Plaintiff'          => $m?->plaintiff->name ?? null,  // adjust to your real column/rel
                'Defendant'          => $m?->defendant->name ?? null,  // adjust to your real column/rel
                'Status'             => $m?->status,
                'Received Date'      => optional($m?->received_date)->format('Y-m-d'),
                'Last Action Date'   => optional($m?->last_action_date)->format('Y-m-d'),
                'Reported Date'      => optional($m?->reported_date)->format('Y-m-d'),
                'Submitted Date'     => optional($m?->submitted_date)->format('Y-m-d'),
                'Claim Status'       => $m?->claim_status ?? null,
                'Claim Amount (no VAT)' => number_format((float)$claimAmount, 2, '.', ''),
                'Claim Dues'         => $m?->claim_dues ?? null,       // if you have it
                'Claim Collected'    => $m?->claim_collected ?? null,  // if you have it
                'Notes'              => isset($m->notes)
                    ? Str::limit(is_iterable($m->notes) ? collect($m->notes)->pluck('text')->implode(' | ') : (string)$m->notes, 500)
                    : null,
            ];

            // new concepts (always include; or include only if $wantCommissionCols)
            $new = [
                'Working Days'       => (int)($row['period'] ?? 0),
                'Count in Period'    => (int)($row['count_in_period'] ?? 0),
                'Commission %'       => $row['commission_percent'] ?? 0,
                'Commission Amount'  => number_format((float)($row['commission_amount'] ?? 0), 2, '.', ''),
            ];

            return $wantCommissionCols ? array_merge($base, $new) : $base;
        })->values()->all();

        return $rows;
    }

    private function buildCommissionViewData(Request $request): array
    {
        // Base lists for selects
        [$experts, $assistants, $types, $courts, $claimsStatus] = $this->common->fetchDataForForm();

        // Matters per filters (same as view)
        $matters = (new MatterService())->setFilters($request)->getForExcel()->get();
        $matterLookup = $matters->keyBy('id');
        $matterIds = $matters->pluck('id')->all();

        // Dates (same defaults as view)
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date',   now()->endOfMonth()->toDateString());

        // Summary rows (one row per matter×assistant), same sorting as view
        $commissionSummary = collect(\App\Models\Matter::getCommissionSummaryByPeriod($startDate, $endDate))
            ->whereIn('case_id', $matterIds)        // keep only filtered matters
            ->sortBy('assistant_id')                // EXACTLY like view
            ->values()
            ->all();

        return compact(
            'experts','assistants','types','courts','claimsStatus',
            'matters','matterLookup','commissionSummary','startDate','endDate'
        );
    }

    public function export(Request $request)
    {
        $action = $request->input('action');
        if ($action === 'view') {
            return $this->showCommissionFormResult($request);
        }

        abort_unless(auth()->user()->can('matter-export'), 403);

        // Build the SAME dataset used by the view
        $data = $this->buildCommissionViewData($request);

        // If user chose to display commission, export the SAME rows shown
        if ($request->boolean('for_commission', false)) {
            $rows = $this->buildCombinedRows($request); // 👈 EXACT dataset used for export
            $filename = 'matters-' . now()->format('Ymd-His') . '.xlsx';
            return (new MattersExport($rows))->download($filename);
        }

        // Otherwise, fall back to your existing matters export
        $filename = 'matters-' . now()->format('Ymd-His') . '.xlsx';
        return (new \App\Exports\MattersExport($request))->download($filename);
    }


    public function showCommissionFormResult(Request $request)
    {
        $data = $this->buildCommissionViewData($request);
        // sends: experts, assistants, types, courts, claimsStatus, matters, commissionSummary, matterLookup, startDate, endDate
        return view('pages.matters.export.filter', $data)
            ->withInput($request->all());
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
            'parent_id' => 'nullable|exists:matters,id',
        ]);
        $matter->fill($validated);
        $matter->save();
        return redirect(url()->previous())->withToastSuccess(__('app.record-updated-successfully'));
    }

    public function clone(Matter $matter, bool $without_parties = false): \Illuminate\Http\RedirectResponse
    {
        $newMatter = $matter->replicate();
        $newMatter->status = 'current';
        $newMatter->reported_date = null;
        $newMatter->submitted_date = null;
        $newMatter->claim_status = 'unpaid';
        $newMatter->push();
        $relations = ['experts'];
        if (!$without_parties) {
            $relations[] = 'parties';
        }
        $matter->load($relations);

        foreach ($matter->getRelations() as $relation => $items) {
            if ($items->isEmpty()) {
                continue; // Skip empty relations
            }

            // Check if the relation uses a pivot table
            if (method_exists($matter->{$relation}(), 'getPivotColumns')) {
                foreach ($items as $item) {
                    $pivotData = $item->pivot->toArray() ?? [];
                    unset($pivotData['matter_id']); // Remove the old matter ID if necessary
                    $newMatter->{$relation}()->attach($item->id, $pivotData);
                }
            } else {
                // For normal (non-pivot) relations, just sync IDs
                $newMatter->{$relation}()->sync($items->pluck('id')->toArray());
            }
        }

        return redirect()->route('matter.edit', $newMatter);
    }

}
