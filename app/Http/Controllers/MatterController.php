<?php

namespace App\Http\Controllers;

use App\DataTables\MatterDataTable;
use App\Http\Requests\CreateMatterRequest;
use App\Http\Requests\UpdateMatterRequest;
use App\Jobs\CreateMatter;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
use App\Models\User;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMatterRequest $request)
    {
        $matter = CreateMatter::dispatchSync($request->validated());

        return redirect()->route('matter.show', $matter->getInserted());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function show(Matter $matter)
    {
        return view('pages.matters.show', compact('matter'));
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
    public function update(UpdateMatterRequest $request, matter $matter)
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
