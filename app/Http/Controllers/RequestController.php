<?php

namespace App\Http\Controllers;

use App\DataTables\RequestDatatable;
use App\Models\Matter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index(RequestDatatable $datatable)
    {
        return $datatable->render('pages.matters.request.index');
    }

    public function store(Request $request, Matter $matter)
    {
        $validated = $request->validate([
            'request.type' => 'required',
            'request.comment' => 'string|nullable',
            'request.uploaded_file_path' => 'string|nullable',
        ]);
        DB::transaction(function () use ($matter, $request, $validated) {


            $matterRequest = $matter->requests()->create([
                'request_by' => $request->user()->id,
                'type' => $validated['request']['type'],
                'comment' => $validated['request']['comment'],
            ]);
            if (!empty($validated['request']['uploaded_file_path'])) {
                $matterRequest->attachments()->create([
                    'path' => $validated['request']['uploaded_file_path'],
                    'name' => 'request'
                ]);
            }

        });
        return redirect()->back()->with('success', 'Request has been submitted');


    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // store in /storage/app/public/uploads

            return response()->json(['file_path' => '/storage/' . $path]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function approve(Request $baseRequest, \App\Models\Request $request)
    {
        $request->approved_by = $baseRequest->user()->id;
        $request->approved_at = now();
        if ($baseRequest->has('request.approved_comment')) {
            $request->approved_comment = $baseRequest->get('request.approved_comment');
        }
        if (!empty($validated['request']['uploaded_file_path'])) {
            $request->attachments()->create([
                'path' => $validated['request']['uploaded_file_path'],
                'name' => 'approval',
            ]);
        }
        $request->status = 'approved';
        $request->save();
        return redirect()->back()->with('success', 'Request has been approved');
    }

    public function reject(Request $baseRequest, \App\Models\Request $request)
    {
        $request->approved_by = $baseRequest->user()->id;
        $request->approved_at = now();
        if ($baseRequest->has('request.approved_comment')) {
            $request->approved_comment = $baseRequest->get('request.approved_comment');
        }
        if (!empty($validated['request']['uploaded_file_path'])) {
            $request->attachments()->create([
                'path' => $validated['request']['uploaded_file_path'],
                'name' => 'rejection',
            ]);
        }
        $request->status = 'rejected';
        $request->save();
        return redirect()->back()->with('success', 'Request has been rejected');
    }
}
