<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Http\Requests\CreateMatterRequest;
use App\Http\Requests\UpdateMatterRequest;
use App\Models\Matter;
use App\Models\Procedure;
use App\Services\MatterService;

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
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function edit(matter $matter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function destroy(matter $matter)
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
}
