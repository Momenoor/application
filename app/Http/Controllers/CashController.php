<?php

namespace App\Http\Controllers;

use App\Events\MatterClaimChanged;
use App\Models\Cash;
use App\Models\Matter;
use Illuminate\Http\Request;

class CashController extends Controller
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
    public function collect(Matter $matter, Request $request)
    {
        $collection = null;
        $validated = $request->validate([
            'cash.amount' => 'required|numeric',
            'cash.description' => 'string|nullable',
        ]);

        /* $collection = Cash::make($validated);

        if ($request->has('claim')) {
            $collection->claim_id = $request->get('claim');
        } */

        $claims = $matter->dueClaims();
        $validated = $validated['cash'];
        foreach ($claims as $claim) {
            $collection = null;
            $dueAmount = $claim->getDueAmount();
            if ($validated['amount'] > 0) {



                if ($validated['amount'] >= $dueAmount) {
                    $collection = Cash::make([
                        'amount' => $dueAmount,
                        'description' => $validated['description'],
                        'claim_id' => $claim->id,
                    ]);
                    $matter->cashes()->save($collection);
                    $validated['amount'] = $validated['amount'] - $dueAmount;
                } else if ($validated['amount'] < $dueAmount) {
                    $collection = Cash::make([
                        'amount' => $validated['amount'],
                        'description' => $validated['description'],
                        'claim_id' => $claim->id,
                    ]);
                    $matter->cashes()->save($collection);
                    $validated['amount'] = 0;
                }
            }
        }


        MatterClaimChanged::dispatch($matter);

        return redirect()->to(route('matter.show', $matter))->withToastSuccess('app.claims_collected_successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
