<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Exports\MattersExport;
use App\Models\Cash;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Type;
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
        return $dataTable->render('pages.matters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.matters.form.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function show(Matter $matter)
    {
        $parties = MatterService::partiesResolve($matter);
        return view('pages.matters.show', compact('matter', 'parties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function edit(Matter $matter)
    {
        $id = $matter->id;
        return view('pages.matters.form.update', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matter $matter)
    {
        return redirect(route('matter.index'))->withToastSuccess('Matter Successfully Deleted');
    }

    public function changeStatus(Matter $matter, $status)
    {

        $statuses = config('system.matter.status');
        if (!is_null($status)) {
            if (key_exists($status, $statuses)) {
                $matter->status = $status;
                $matter->{$status . '_date'} = now();
                $matter->procedures()->create([
                    'type' => $status . '_date',
                    'datetime' => now(),
                    'description' => $status . '_date',

                ]);
                $matter->save();
                return redirect()->to(route('matter.show', $matter))->withToastSuccess(__('app.matter-status-changed-successfuly'));
            }
            return redirect()->to(route('matter.show', $matter))->withToastError(__('app.matter-status-cannot-be-changed'));;
        }

        return redirect()->to(route('matter.show', $matter))->withToastError(__('app.matter-status-cannot-be-changed'));;
    }

    public function exportFilterForm()
    {
        $experts = Expert::whereIn('category', [Expert::MAIN, Expert::CERTIFIED])->pluck('name', 'id');
        $assistants = Expert::whereIn('category', [Expert::MAIN, Expert::CERTIFIED, Expert::ASSISTANT])->pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        $courts = Court::pluck('name', 'id');
        $claimsStatus = [
            Cash::OVERPAID,
            Cash::PAID,
            Cash::UNPAID,
            Cash::PARTIAL,
        ];
        return view('pages.matters.export.filter', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus'));
    }

    public function export(Request $request)
    {
        /* $result = app(MatterService::class)->setFilters($request)->getForExcel()->get();
        $experts = Expert::whereIn('category', [Expert::MAIN, Expert::CERTIFIED])->pluck('name', 'id');
        $assistants = Expert::whereIn('category', [Expert::MAIN, Expert::CERTIFIED, Expert::ASSISTANT])->pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        $courts = Court::pluck('name', 'id');
        $claimsStatus = [
            Cash::PAID,
            Cash::UNPAID,
            Cash::PARTIAL,
        ];
        return view('pages.matters.export.filter', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus', 'result')); */
        return (new MattersExport($request))->download('matters-' . now() . '.xlsx');
    }


}
