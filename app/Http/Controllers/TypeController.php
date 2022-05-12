<?php

namespace App\Http\Controllers;

use App\DataTables\TypeDatatable;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypeDatatable $dataTable)
    {
        abort_unless(auth()->user()->can('type-view'), '403');
        return $dataTable->render('pages.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(auth()->user()->can('type-create'), '403');
        return view('pages.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:types,name',
        ]);

        Type::create($validated);
        return redirect(route('type.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        abort_unless(auth()->user()->can('type-view'), '403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        abort_unless(auth()->user()->can('type-edit'), '403');
        return view('pages.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {

        $validated = $request->validate([
            'name' => 'required|unique:types,name,' . $type->id . ',id',
            'active' => 'nullable',
        ]);

        if (!data_get($validated, 'active')) {
            $validated['active'] = 'false';
        }

        $type->fill($validated);
        $type->saveOrFail();
        return redirect(route('type.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        abort_unless(auth()->user()->can('type-delete'), '403');
        $type->delete();
        return redirect(route('type.index'))->withToastSuccess(__('app.record_deleted_successfully'));
    }
}
