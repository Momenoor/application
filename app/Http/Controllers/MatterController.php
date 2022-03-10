<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
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
        return $dataTable->render('pages.matters.form.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $experts = Expert::whereIn('category', ['main', 'certified'])->get();
        $courts = Court::all();
        $types = Type::all();
        $parties = Party::where('type', 'party')->get();
        $advocates = Party::whereIn('type', ['office', 'advocate'])->get();
        $committees = Expert::CommitteesList()->get();
        $partyTypes = config('system.party.type');
        return view('pages.matters.form.create', compact(
            'experts',
            'partyTypes',
            'courts',
            'types',
            'parties',
            'advocates',
            'committees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function show(Matter $matter)
    {
        dd($matter);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, matter $matter)
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
        return redirect(route('matter.index'))->withToastSuccess('Matter Successfully Deletete');
    }
}
