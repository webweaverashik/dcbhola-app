<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $letters = 'SELECT * FROM letters l, sections s WHERE l.section_to = s.id';
        $letters = DB::table('letters')->join('sections', 'letters.section_to', '=', 'sections.id')->join('users', 'letters.uploaded_by', '=', 'users.id')->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')->get();

        // return $letters;

        return view('letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::get();
        return view('letters.upload', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'memorandum_no' => 'nullable|string',
            'received_date' => 'required|date',
            'sender_name'   => 'required|string',
            'sent_date'     => 'required|date',
            'short_title'   => 'required|string',
            'section_to'    => 'integer',
            'file_url'      => 'required|mimes:pdf|max:3072'
        ]);

        if ($request->has('file_url')) {
            $file = $request->file('file_url');
            $extension = $file->getClientOriginalExtension();

            $filename = 'letter_' . date('d-m-Y_H-i-s') . '.' . $extension;
            
            $path = 'uploads/files/' . date('M-Y') . '/';
            // $file->move($path, $filename);

        } else {
            $path = NULL;
            $filename = NULL;
        }


        Letter::create([
            'memorandum_no'     => $request->memorandum_no,
            'received_date'     => $request->received_date,
            'sender_name'       => $request->sender_name,
            'sent_date'         => $request->sent_date,
            'short_title'       => $request->short_title,
            'uploaded_by'       => Session::get('loginId'),
            'section_to'        => $request->section_to,
            'file_url'          => $path.$filename
        ]);

        $file->move($path, $filename);

        
        return redirect('/letters')->with('success', 'পত্রটি সফলভাবে আপলোড করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
