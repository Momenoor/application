<?php

namespace App\Http\Controllers;

use App\Models\vacation;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.vacations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vacations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('start_end_date')) {
            $dates = $request->get('start_end_date');
            $dates = Str::of($dates)->explode(' - ');
            $request->merge(['start_date' => Carbon::make($dates[0]), 'end_date' => Carbon::make($dates[1])->addDay(1)]);
        }

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required',
        ]);

        Vacation::create($validated);

        return redirect(route('vacation.index'))->withToastSuccess(__('app.record-added-successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(vacation $vacation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(vacation $vacation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vacation $vacation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(vacation $vacation)
    {
        //
    }
}
