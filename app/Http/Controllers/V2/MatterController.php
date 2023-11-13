<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Type;

class MatterController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $courts = Court::all();
        $types = Type::all();
        $levels = collect(config('system.level'))->map(function($item){
            return (object) $item;
        });
        $experts = Expert::all();
        $claimsTypes = config('system.claims.types');
        return view('pages.matters.v2.create', compact('courts', 'types', 'levels', 'experts','claimsTypes'));
    }
}
