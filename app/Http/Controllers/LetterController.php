<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\JoinClause;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = session('role');
        
        if ($role == 3) 
        {

            $letters = DB::table('letters')
                        ->join('sections', 'letters.section_to', '=', 'sections.id')
                        ->join('users', 'letters.uploaded_by', '=', 'users.id')
                        ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                        ->where('letters.uploaded_by', session('loginId'))
                        ->where('sections.staff_id', session('loginId'))
                        ->where('letters.is_deleted', 0)
                        ->get();

                        
            // return $letters;
        }
        elseif ($role == 2) 
        {
            $letters = DB::table('letters')
                        // ->join('sections', 'letters.section_to', '=', 'sections.id')
                        ->join('users', 'letters.uploaded_by', '=', 'users.id')
                        ->join('sections', function (JoinClause $join) {
                                    $join->on('letters.section_to', '=', 'sections.id')
                                        ->where('sections.officer_id', '=', session('loginId'));
                                })
                        ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                        ->where('letters.is_deleted', 0)
                        ->get();

                        
            // return $letters;
        }
        else  // DC Role
        {
            $letters = DB::table('letters')
                        ->join('sections', 'letters.section_to', '=', 'sections.id')
                        ->join('users', 'letters.uploaded_by', '=', 'users.id')
                        ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                        ->where('letters.is_deleted', 0)
                        ->get();

            // return $letters;
        }

        return view('letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sections = Section::get();


        $role = session('role');
        
        if ($role == 3) 
        {
            $sections = DB::table('sections')
                        ->where('sections.staff_id', session('loginId'))
                        ->get();
                        
            // return $sections;
        }

        elseif ($role == 2) 
        {
            $sections = DB::table('sections')
                        ->where('sections.officer_id', session('loginId'))
                        ->get();

            // return $letters;
        }

        else  // DC Role & Frontdesk
        {
            $sections = Section::get();

            // return $sections;
        }

        return view('letters.create', compact('sections'));
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
            'section_to'    => 'required|integer',
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

        $role = session('role');
        
        if ($role == 3) 
        {
            $sections = DB::table('sections')
                        ->where('sections.staff_id', session('loginId'))
                        ->get();
        }

        elseif ($role == 2) 
        {
            $sections = DB::table('sections')
                        ->where('sections.officer_id', session('loginId'))
                        ->get();
        }

        else  // DC Role & Frontdesk
        {
            $sections = Section::get();
        }

        $letter = Letter::findOrFail($id);

        // return $letter;

        return view('letters.edit', compact('letter', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'memorandum_no' => 'nullable|string',
            'received_date' => 'required|date',
            'sender_name'   => 'required|string',
            'sent_date'     => 'required|date',
            'short_title'   => 'required|string',
            'section_to'    => 'required|integer',
            'file_url'      => 'required|mimes:pdf|max:3072'
        ]);

        $letter = Letter::findOrfail($id);

        if ($request->has('file_url')) {
            $file = $request->file('file_url');
            $extension = $file->getClientOriginalExtension();

            $filename = 'letter_' . date('d-m-Y_H-i-s') . '.' . $extension;
            
            $path = 'uploads/files/' . date('M-Y') . '/';
            $file->move($path, $filename);

            if (File::exists($letter->file_url)) {
                File::delete($letter->file_url);
            }
        }
        // else {
        //     $path = NULL;
        //     $filename = NULL;
        // }


        Letter::findOrfail($id)->update([
            'memorandum_no'     => $request->memorandum_no,
            'received_date'     => $request->received_date,
            'sender_name'       => $request->sender_name,
            'sent_date'         => $request->sent_date,
            'short_title'       => $request->short_title,
            // 'uploaded_by'       => Session::get('loginId'),
            'section_to'        => $request->section_to,
            'file_url'          => $path.$filename
        ]);

        // $file->move($path, $filename);

        
        return redirect('/letters')->with('success', 'পত্রটি সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Letter::where('id', $id)->update([
            'is_deleted' => 1,
        ]);
        
        // DB::table('letters')->where('id', $id)->update(['is_deleted' => 1]);

        return redirect()->back()->with('success', 'চিঠি/ডাক সফলভাবে ডিলিট হয়েছে।');
    }
}
