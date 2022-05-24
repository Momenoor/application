<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $model = $request->get('model') ?: Event::class;

        $query = $model::select(['id', 'start_date as start', 'end_date as end', 'title', 'type', 'all_day as allDay', 'url']);

        if ($request->has('from')) {
            $query->whereDate('start_date', '>=', $request->get('from'));
        }

        if ($request->has('to')) {
            $query->whereDate('end_date', '<=',  $request->get('to'));
        }

        $data = $query->get()->toArray();
        return response()->json($data);
    }
}
