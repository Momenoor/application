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
        $where = [];
        $model = $request->get('model') ?: Event::class;

        $query = $model::select(['start_date as start', 'end_date as end', 'title', 'type', 'all_day as allDay','url']);

        if ($request->has('from')) {
            $where['from'] = $request->get('from');
        }

        if ($request->has('to')) {
            $where['to'] = $request->get('to');
        }

        if (count($where) > 0) {
            if (key_exists('from', $where)) {
                $query->where('start_date', '>=', $where['from']);
            }

            if (key_exists('to', $where)) {
                $query->where('end_date', '<=', $where['to']);
            }
        }

        $data = $query->get()->toArray();
        return response()->json($data);
    }
}
