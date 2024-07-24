<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Letter;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Rakibhstu\Banglanumber\NumberToBangla;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = session('role');

        if ($role == 4) { // section staff
            $letters = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->join('users', 'letters.uploaded_by', '=', 'users.id')
                    ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                            // ->where('letters.uploaded_by', session('loginId'))
                    ->where('sections.staff_id', session('loginId'))
                    ->where('letters.is_deleted', 0)
                    ->orderBy('created_at', 'DESC')
                    ->get();

            $sections = Section::where('staff_id', '=', session('loginId'))->get();
        } elseif ($role == 3) { // section officers
            $letters = DB::table('letters')
                            // ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->join('users', 'letters.uploaded_by', '=', 'users.id')
                    ->join('sections', function (JoinClause $join) {
                        $join->on('letters.section_to', '=', 'sections.id')
                            ->where('sections.officer_id', '=', session('loginId'));
                    })
                    ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                    ->where('letters.is_deleted', 0)
                    ->orderBy('created_at', 'DESC')
                    ->get();

            $sections = Section::where('officer_id', '=', session('loginId'))->get();
        } elseif ($role == 2) { // ADC officers
            $letters = DB::table('letters')
                            // ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->join('users', 'letters.uploaded_by', '=', 'users.id')
                    ->join('sections', function (JoinClause $join) {
                        $join->on('letters.section_to', '=', 'sections.id')
                            ->where('sections.adc_id', '=', session('loginId'));
                    })
                    ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                    ->where('letters.is_deleted', 0)
                    ->orderBy('created_at', 'DESC')
                    ->get();

            $sections = Section::where('adc_id', '=', session('loginId'))->get();
        } else { // DC Role
            $letters = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->join('users', 'letters.uploaded_by', '=', 'users.id')
                    ->select('letters.*', 'sections.name as section_name', 'users.name as uploader_user', 'users.designation as designation')
                    ->where('letters.is_deleted', 0)
                    ->orderBy('created_at', 'DESC')
                    ->get();

            $sections = Section::all();
        }

        // Create an instance of the NumberToBangla class
        $numToBangla = new NumberToBangla();

        // Iterate over each student and convert phone numbers, birth date, and created_at to Bangla for frontend display
        $letters->transform(function ($letter) use ($numToBangla) {
            $letter->received_date_bn = $this->convertDateToBangla(new \DateTime($letter->received_date), $numToBangla);

            return $letter;
        });

        $users = User::where('is_deleted', 0)->where('role', 4)->get(); // uploaded_by filter

        return view('letters.index', compact('letters', 'users', 'sections'));
    }

    public function convertDateTimeToBangla($dateTime, $numToBangla)
    {
        $hour = date('H', strtotime($dateTime));

        if (is_string($dateTime)) {
            // Convert the string to a DateTime object
            $dateTime = new \DateTime($dateTime);
        }

        // Extract date components
        $year = $numToBangla->bnNum($dateTime->format('Y'));
        $month = $numToBangla->bnNum($dateTime->format('m'));
        $day = $numToBangla->bnNum($dateTime->format('d'));
        $hourB = $numToBangla->bnNum($dateTime->format('h'));
        $minute = $numToBangla->bnNum($dateTime->format('i'));
        $second = $numToBangla->bnNum($dateTime->format('s'));

        // $hour = date("H", strtotime($dateTime));
        $period = '';
        if ($hour >= 5 && $hour < 12) {
            $period = 'সকাল';
        } elseif ($hour >= 12 && $hour < 17) {
            $period = 'দুপুর';
        } elseif ($hour >= 17 && $hour < 19) {
            $period = 'বিকাল';
        } elseif ($hour >= 19 && $hour < 21) {
            $period = 'সন্ধ্যা';
        } else {
            $period = 'রাত';
        }

        // Construct Bangla date string
        return "{$day}-{$month}-{$year}, {$period} {$hourB}:{$minute}";
    }

    public function convertDateToBangla($date, $numToBangla)
    {
        // Extract date components
        $year = $numToBangla->bnNum($date->format('Y'));
        $month = $numToBangla->bnNum($date->format('m'));
        $day = $numToBangla->bnNum($date->format('d'));

        // Construct Bangla date string
        return "{$day}-{$month}-{$year}";
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $role = session('role');

        if ($role == 4) {
            $sections = DB::table('sections')
                ->where('sections.staff_id', session('loginId'))
                ->get();
            // return $sections;
        } else { // Other users are unable to create
            return back()->with('warning', 'ঐ পেজে আপনার অনুমতি নেই।');
        }

        return view('letters.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $request->validate([
            'type' => 'required|integer',
            'memorandum_no' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'received_date' => 'required|date',
            'sender_name' => 'required|string',
            'sent_date' => 'required|date',
            'short_title' => 'required|string',
            'section_to' => 'required|integer',
            'file_url' => 'required|mimes:pdf|max:3072',
        ],
        [
            'type.required' => 'পত্রের ধরণ নির্ধারণ করতে হবে',
            'received_date.required' => 'পত্র প্রাপ্তির তারিখ লিখতে হবে',
            'received_date.date' => 'পত্র প্রাপ্তি তারিখ ফরম্যাটে হবে',
            'sender_name.required' => 'পত্র প্রেরণকারী ব্যক্তি বা দপ্তরের নাম লিখতে হবে',
            'sent_date.required' => 'পত্র প্রেরণ তারিখ লিখতে হবে',
            'sent_date.date' => 'পত্র প্রেরণ তারিখ ফরম্যাটে হবে',
            'short_title.required' => 'পত্রের সংক্ষিপ্ত বিষয় লিখতে হবে',
            'section_to.required' => 'শাখা নির্বাচন করতে হবে',
            'file_url.required' => 'পত্রটি আপলোড করতে হবে',
            'file_url.mimes' => 'PDF ফাইল আপলোড করা যাবে',
            'file_url.max' => 'সর্বোচ্চ ৩ মেগাবাইট ফাইল আপলোড করা যাবে',
        ]);

        if ($request->has('file_url')) {
            $file = $request->file('file_url');
            $extension = $file->getClientOriginalExtension();

            $filename = 'letter_'.date('d-m-Y_H-i-s').'.'.$extension;

            $path = 'uploads/files/'.date('M-Y').'/';
            // $file->move($path, $filename);

        } else {
            $path = null;
            $filename = null;
        }

        // Letter type entry
        if ($request->type == '1') {
            Letter::create([
                'type' => $request->type,
                'memorandum_no' => $request->memorandum_no,
                'serial_no' => null,
                'received_date' => $request->received_date,
                'sender_name' => $request->sender_name,
                'sent_date' => $request->sent_date,
                'short_title' => $request->short_title,
                'uploaded_by' => Session::get('loginId'),
                'section_to' => $request->section_to,
                'file_url' => $path.$filename,
            ]);
        } elseif ($request->type == '2') {
            Letter::create([
                'type' => $request->type,
                'memorandum_no' => null,
                'serial_no' => $request->serial_no,
                'received_date' => $request->received_date,
                'sender_name' => $request->sender_name,
                'sent_date' => $request->sent_date,
                'short_title' => $request->short_title,
                'uploaded_by' => Session::get('loginId'),
                'section_to' => $request->section_to,
                'file_url' => $path.$filename,
            ]);
        }
        // letter type entry ends

        $file->move($path, $filename);

        return redirect('/letters')->with('success', 'পত্রটি সফলভাবে আপলোড করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // Retrieve query parameters
        $sectionId = $request->query('section');
        $days = $request->query('days');
        $status = $request->query('status');
        $role = session('role');
        $loginId = session('loginId');

        // Initialize the query
        $letters = DB::table('letters')
            ->join('sections', 'letters.section_to', '=', 'sections.id')
            ->select('letters.*', 'sections.name as section_name')
            ->where('letters.is_deleted', 0)
            ->orderBy('created_at', 'DESC');

        // Handle section filter
        /*
        If section=0, that means all section letters will be shown for role=1 (DC), for role=3 sections.officer_id will be that officer session loginId
        and role=4 sections.staff_id will be that staff session loginId
        */
        if ($sectionId != 0) {
            $letters = $letters->where('letters.section_to', $sectionId);

            // Running this query to fetch the page heading section name
            $section = DB::table('sections')
                ->where('id', $sectionId)
                ->first();
            $sectionName = $section ? $section->name : ''; // Get only the section name
        } elseif ($sectionId == 0) {
            if ($role == 2) {
                $letters = $letters->where('sections.adc_id', $loginId);
            } elseif ($role == 3) {
                $letters = $letters->where('sections.officer_id', $loginId);
            } elseif ($role == 4) {
                $letters = $letters->where('sections.staff_id', $loginId);
            }

            $sectionName = 'সকল শাখা';
        }

        // Handle status
        if ($status != 0) {
            $letters = $letters->where('letters.status', $status);
        }

        // Handle the date range based on the 'days' parameter
        if ($days != 'all_days') {
            $dateRangeStart = null;
            $dateRangeEnd = null;

            if ($days == 'up_to_7_days') {
                $dateRangeStart = now()->subDays(7);
                $dateRangeEnd = now(); // From now to 7 days ago
            } elseif ($days == 'up_to_15_days') {
                $dateRangeStart = now()->subDays(15);
                $dateRangeEnd = now()->subDays(8); // From 8 to 15 days ago
            } elseif ($days == 'up_to_30_days') {
                $dateRangeStart = now()->subDays(30);
                $dateRangeEnd = now()->subDays(16); // From 16 to 30 days ago
            } elseif ($days == 'days_30_plus') {
                $dateRangeStart = now()->subDays(30);
                $dateRangeEnd = null; // More than 30 days
            }

            // Apply the date filters
            if ($days == 'days_30_plus') {
                $letters = $letters->where('letters.created_at', '<=', $dateRangeStart);
            } else {
                $letters = $letters->whereBetween('letters.created_at', [$dateRangeStart, $dateRangeEnd]);
            }
        }

        $letters = $letters->get();

        // Create an instance of the NumberToBangla class
        $numToBangla = new NumberToBangla();

        // Iterate over each student and convert phone numbers, birth date, and created_at to Bangla for frontend display
        $letters->transform(function ($letter) use ($numToBangla) {
            $letter->received_date_bn = $this->convertDateToBangla(new \DateTime($letter->received_date), $numToBangla);

            return $letter;
        });

        // return $sectionName;
        // return $letters;

        return view('letters.show', compact('letters', 'sectionName'));
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
                'l.type',
                'l.memorandum_no',
                'l.serial_no',
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

        // Create an instance of the NumberToBangla class
        $numToBangla = new NumberToBangla();

        // Iterate over each student and convert phone numbers, birth date, and created_at to Bangla for frontend display
        // Convert dates to Bangla
        $letter->created_at_bn = $this->convertDateTimeToBangla($letter->created_at, $numToBangla);
        $letter->sent_date_bn = $this->convertDateToBangla(new \DateTime($letter->sent_date), $numToBangla);
        $letter->received_date_bn = $this->convertDateToBangla(new \DateTime($letter->received_date), $numToBangla);

        foreach ($comments as $comment) {
            $comment->created_at_bn = $this->convertDateTimeToBangla($comment->created_at, $numToBangla);
        }

        $output = [
            'letter' => $letter,
            'comments' => $comments,
        ];

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $role = session('role');

        if ($role != 3) { // Only section officer is allowed to edit the letter
            return back()->with('warning', 'ঐ পেজে আপনার অনুমতি নেই।');
        }

        $sections = DB::table('sections')
            ->where('sections.officer_id', session('loginId'))
            ->get();

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
        if (Session::get('role') == 3) {
            $request->validate([
                'type' => 'required|integer',
                'memorandum_no' => 'nullable|string',
                'serial_no' => 'nullable|string',
                'received_date' => 'required|date',
                'sender_name' => 'required|string',
                'sent_date' => 'required|date',
                'short_title' => 'required|string',
                'section_to' => 'required|integer',
                'status' => 'required',
                'comment' => 'required|string',
            ],
            [
                'type.required' => 'পত্রের ধরণ নির্ধারণ করতে হবে',
                'received_date.required' => 'পত্র প্রাপ্তির তারিখ লিখতে হবে',
                'received_date.date' => 'পত্র প্রাপ্তি তারিখ ফরম্যাটে হবে',
                'sender_name.required' => 'পত্র প্রেরণকারী ব্যক্তি বা দপ্তরের নাম লিখতে হবে',
                'sent_date.required' => 'পত্র প্রেরণ তারিখ লিখতে হবে',
                'sent_date.date' => 'পত্র প্রেরণ তারিখ ফরম্যাটে হবে',
                'short_title.required' => 'পত্রের সংক্ষিপ্ত বিষয় লিখতে হবে',
                'section_to' => 'শাখা নির্বাচন করতে হবে',
                'status.required' => 'পত্রের অবস্থা নির্বাচন করতে হবে',
                'comment.required' => 'মন্তব্য যুক্ত করতে হবে',
            ]);

            // Letter type entry
            if ($request->type == '1') { // দাপ্তরিক ডাক
                Letter::findOrfail($id)->update([
                    'type' => $request->type,
                    'memorandum_no' => $request->memorandum_no,
                    'serial_no' => null,
                    'received_date' => $request->received_date,
                    'sender_name' => $request->sender_name,
                    'sent_date' => $request->sent_date,
                    'short_title' => $request->short_title,
                    'section_to' => $request->section_to,
                    'status' => $request->status,
                ]);
            } elseif ($request->type == '2') {  // নাগরিক ডাক
                Letter::findOrfail($id)->update([
                    'type' => $request->type,
                    'memorandum_no' => null,
                    'serial_no' => $request->serial_no,
                    'received_date' => $request->received_date,
                    'sender_name' => $request->sender_name,
                    'sent_date' => $request->sent_date,
                    'short_title' => $request->short_title,
                    'section_to' => $request->section_to,
                    'status' => $request->status,
                ]);
            }

            Comment::create([
                'letter_id' => $id,
                'comment' => $request->comment,
                'comment_by' => Session::get('loginId'),
            ]);
        } else {
            return redirect('/letters')->with('warning', 'আপনার এই কার্যক্রমের অনুমতি নেই।');
        }

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
