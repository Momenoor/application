<?php

namespace App\Http\Controllers;

use App\DataTables\Matter2DataTable;
use App\Models\Matter;
use App\Models\Party;
use App\Services\MatterService;
use App\Services\PartyService;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Party $party)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        //
    }


    public function linkSubPartyToMatter(Request $request, Matter $matter)
    {

        $validated = $request->validate([
            'party.id' => 'required',
            'party.subparty' => 'required',
        ]);

        $partyType = MatterService::make($matter)->getPartyType(data_get($validated, 'party.id'));
        $subparty[data_get($validated, 'party.subparty')] = [
            'type' => $partyType . '_advocate',
            'parent_id' => data_get($validated, 'party.id'),
        ];
        $matter->parties()->attach($subparty);

        return redirect()->to(url()->previous())->withToastSuccess(__('app.party_added_successfully'));
    }

    public function addPartyToMatter(Request $request, Matter $matter)
    {

        $validated = $request->validate([
            'party.name' => 'required',
            'party.type' => 'required',
            'party.phone' => 'nullable',
            'party.email' => 'nullable',
        ]);

        $party = PartyService::findOrCreate($validated['party']);

        $linkedParty[$party->id] = [
            'type' => data_get($validated, 'party.type'),
        ];
        $matter->parties()->detach($party->id);
        $matter->parties()->attach($linkedParty);

        return redirect()->to(url()->previous())->withToastSuccess(__('app.party_added_successfully'));
    }
}
