<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Http\Requests\CreateMatterRequest;
use App\Http\Requests\UpdateMatterRequest;
use App\Models\Matter;
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
        return view('pages.matters.show', compact('matter','parties'));
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
}
