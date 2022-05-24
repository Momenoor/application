<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
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
        $calendar = \Calendar::addEvents(Event::all())->setOptions(['locale' => app()->getLocale()]);
        return view('pages.vacations.index', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = request()->get('type');

        abort_unless(in_array($type, config('system.events.types')), 404);

        $data = [];
        if ($type == 'annual_leave') {
            $data['users'] = User::all();
        }

        return view('pages.vacations.' . $type . '.create', compact('data'));
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
            'type' => 'required',
            'request_by' => 'nullable',
        ]);

        if ($validated['type'] == 'annual_leave') {
            $request_by = User::findOrFail($validated['request_by']);
            $validated['title'] = $validated['title'] . ' ( ' . $request_by->display_name . ' )';
        }

        $event = Event::create($validated);
        $event->url = route('vacation.show', $event->id);
        $event->all_day = 'true';
        $event->save();

        return redirect(route('vacation.index'))->withToastSuccess(__('app.record-added-successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ُEvent  $ُEvent
     * @return \Illuminate\Http\Response
     */
    public function show(Event $ُevent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ُEvent  $ُevent
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $ُevent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ُEvent  $ُevent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $ُevent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $ُevent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $ُevent)
    {
        //
    }
}
