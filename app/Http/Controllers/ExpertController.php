<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertDatatable;
use App\Models\Expert;
use App\Models\Matter;
use App\Services\ExpertService;
use Illuminate\Http\Request;
use simplehtmldom\HtmlWeb;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpertDatatable $dataTable)
    {
        return $dataTable->render('pages.experts.index');
    }

    public function getExpertsDataFromUrlForm()
    {
        return view('pages.experts.get-experts-data-from-url-form');
    }

    public function getExpertsDataFromUrl(Request $request)
    {

        $data = [];

        $url = $request->get('data-url');

        $doc = new HtmlWeb();
        $html = $doc->load($url);

        foreach ($html->find('table') as $table) {
            foreach ($table->find('tr') as $index => $row) {
                $data[$index]['name'] = $row->find('td', 0)->plaintext ?? null;
                $data[$index]['phone'] = $row->find('td', 2)->plaintext ?? null;
                $data[$index]['email'] = $row->find('td', 3)->plaintext ?? null;
                $data[$index]['address'] = $row->find('td', 4)->plaintext ?? null;
            }
        }

        $data = $html->plaintext;

        return view('pages.experts.get-experts-data-from-url-result', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.experts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        (new ExpertService)->save($request);
        return redirect(route('expert.index'))->withToastSuccess(__('app.record-added-successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $expert)
    {
        dd($expert->matters);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        return view('pages.experts.edit', compact('expert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
    {
        if (!$request->has('newexpert.active')) {
            $new = $request->get('newexpert');
            $new['active'] = 'inactive';
            $request->merge(['newexpert' => $new]);
        }

        $validated = $request->validate(
            [
                'newexpert.name' => 'required|unique:experts,name,' . $expert->id . ',id',
                'newexpert.phone' => 'required',
                'newexpert.email' => 'required|email',
                'newexpert.field' => 'required',
                'newexpert.category' => 'required|in:main,certified,assistant,external,external-assistant',
                'newexpert.active' => 'required|in:active,inactive',
            ]
        );

        $data = $validated['newexpert'];

        $expert->fill($data);
        $expert->save();
        return redirect(route('expert.index'))->withToastSuccess(__('app.record-updated-successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert)
    {

        if ($expert->matters()->exists() or $expert->asAssistant()->exists()) {
            return redirect(route('expert.index'))->with('warning', __('app.record_can\'t_be_deleted'));
        }

        $expert->delete();
        return redirect(route('expert.index'))->withToastSuccess(__('app.record_deleted_successfully'));
    }

    public function assignAssistant(Request $request, Matter $matter)
    {
        $validated = $request->validate([
            'expert.assistant' => 'required|exists:experts,id',
        ]);

        $assistant[data_get($validated, 'expert.assistant')] = ['type' => 'assistant'];
        $matter->experts()->detach(data_get($validated, 'expert.assistant'));
        $matter->experts()->attach($assistant);

        return redirect()->to(url()->previous())->withToastSuccess(__('app.assistant-assigned-successfully'));
    }
}
