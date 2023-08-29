<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(procedure $procedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(procedure $procedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, procedure $procedure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(procedure $procedure)
    {
        //
    }

    public function addNextSessionDate(Request $request, Matter $matter)
    {

        $validate = $this->validate($request, [
            'procedure.datetime' => 'required',
            'procedure.description' => 'string|nullable',
        ]);

        $validate = $validate['procedure'];

        $validate['type'] = 'next_session_date';
        $matter->next_session_date = $validate['datetime'];
        $matter->procedures()->create($validate);
        $matter->save();

        return redirect()->to(route('matter.show', $matter))->withToastSuccess(__('app.next-session-date-set-successfully'));
    }

    public function changeDate(Request $request, Matter $matter)
    {
        $validate = $this->validate($request, [
            'procedure.datetime' => 'required',
            'procedure.type' => 'required',
        ]);

        $validate = $validate['procedure'];

        $matter->{$validate['type']} = $validate['datetime'];
        $procedure = $matter->procedures()->where('type', $validate['type'])->firstOrNew();
        $procedure->datetime = $validate['datetime'];
        $procedure->save();
        $matter->save();

        return redirect()->to(route('matter.show', $matter))->withToastSuccess(__('app.date-set-successfully'));
    }
}
