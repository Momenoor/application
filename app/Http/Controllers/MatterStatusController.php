<?php

namespace App\Http\Controllers;

use App\Models\MatterStatus;
use Illuminate\Http\Request;

class MatterStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $statuses = MatterStatus::all();
        return view('pages.matters.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MatterStatus $matterStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MatterStatus $matterStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MatterStatus $matterStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(MatterStatus $matterStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MatterStatus $matterStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatterStatus $matterStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MatterStatus $matterStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatterStatus $matterStatus)
    {
        //
    }
}
