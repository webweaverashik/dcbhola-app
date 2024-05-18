<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Comment;
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
        
        if ($role == 4) // frontdesk users
        {

            $letters = DB::table('letters')
                        ->join('sections', 'letters.section_to', '=', 'sections.id')
                        ->join('users', 'letters.uploaded_by', '=', 'users.id')
                        ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                        ->where('letters.uploaded_by', session('loginId'))
                        ->where('letters.is_deleted', 0)
                        ->get();
                        
            // return $letters; 
        }
        if ($role == 3) // section staff
        {

            $letters = DB::table('letters')
                        ->join('sections', 'letters.section_to', '=', 'sections.id')
                        ->join('users', 'letters.uploaded_by', '=', 'users.id')
                        ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                        // ->where('letters.uploaded_by', session('loginId'))
                        ->where('sections.staff_id', session('loginId'))
                        ->where('letters.is_deleted', 0)
                        ->get();

            // return $letters; 
        }
        elseif ($role == 2) // section officers
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
        }
        else // DC Role
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
     * AJAX request for letters
     */
    public function ajaxLetterInfo(string $id)
    {
        $letter = DB::table('letters as l')
                ->join('sections as s', 'l.section_to', '=', 's.id')
                ->join('users as u', 'l.uploaded_by', '=', 'u.id')
                ->select(
                    'l.id',
                    'l.received_date',
                    'l.sender_name',
                    'l.sent_date',
                    'l.short_title',
                    'l.memorandum_no',
                    'u.name as uploader_name',
                    'u.designation as uploader_designation',
                    's.name as section_name',
                    'l.file_url',
                    'l.is_deleted',
                    'l.status',
                    'l.created_at',
                    'l.updated_at'
                )
                ->where('l.id', $id)
                ->first();

        $comments = DB::table('comments as c')
                    ->join('users as u', 'c.comment_by', '=', 'u.id')
                    ->select(
                        'c.id as comment_id',
                        'c.comment',
                        'u.name as comment_by_name',
                        'u.designation as commenter_designation',
                        'c.created_at',
                        'c.updated_at'
                    )
                    ->where('c.letter_id', $id)
                    ->orderBy('c.created_at', 'desc')
                    ->get();

        $output = [
            'letter' => $letter,
            'comments' => $comments
        ];
        
        return $output;
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
        // return $request;

        // admin and officer are allowed to update status and comment on
        if (Session::get('role') == 1 || Session::get('role') == 2) {
            $request->validate([
                'memorandum_no' => 'nullable|string',
                'received_date' => 'required|date',
                'sender_name'   => 'required|string',
                'sent_date'     => 'required|date',
                'short_title'   => 'required|string',
                'section_to'    => 'required|integer',
                'status'        => 'required',
                'comment'       => 'nullable|string',
            ]);

            Letter::findOrfail($id)->update([
                'memorandum_no'     => $request->memorandum_no,
                'received_date'     => $request->received_date,
                'sender_name'       => $request->sender_name,
                'sent_date'         => $request->sent_date,
                'short_title'       => $request->short_title,
                'section_to'        => $request->section_to,
                'status'            => $request->status,
            ]);

            Comment::create([
                'letter_id' => $id,
                'comment' => $request->comment,
                'comment_by' => Session::get('loginId'),
            ]);
        }
        else {
            $request->validate([
                'memorandum_no' => 'nullable|string',
                'received_date' => 'required|date',
                'sender_name'   => 'required|string',
                'sent_date'     => 'required|date',
                'short_title'   => 'required|string',
                'section_to'    => 'required|integer',
            ]);

            Letter::findOrfail($id)->update([
                'memorandum_no'     => $request->memorandum_no,
                'received_date'     => $request->received_date,
                'sender_name'       => $request->sender_name,
                'sent_date'         => $request->sent_date,
                'short_title'       => $request->short_title,
                'section_to'        => $request->section_to,
            ]);
        }
        // return Letter::findOrfail($id);

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
