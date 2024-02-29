<?php

namespace App\Http\Controllers;

use App\Imports\CommissionImport;
use App\Models\Commission;
use App\Models\Matter;
use App\Services\Common;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CommissionController extends Controller
{


    public function __construct(private readonly Common $common)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        list($experts, $assistants, $types, $courts, $claimsStatus) = $this->common->fetchDataForForm();
        return view('pages.commissions.create', compact('experts', 'assistants', 'types', 'courts', 'claimsStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $matters = Matter::query()->whereBetween('reported_date', [$request->input('start_date'), $request->input('end_date')])->with(['expert', 'court', 'type'])->withSum('claims','amount')->get();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Commission $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Commission $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Commission $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Commission $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        //
    }

    public function importForm()
    {
        return view('pages.commissions.import-form');
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls'
        ]);

        $path = realpath($request->file->getRealPath());
        Excel::import($class = new CommissionImport(), $path);

        return view('pages.commissions.index', ['data' => $class->data]);
    }

}
