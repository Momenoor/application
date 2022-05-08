<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Matter;
use Illuminate\Http\Request;
use simplehtmldom\HtmlWeb;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert)
    {
        //
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
