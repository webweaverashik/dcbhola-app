<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = DB::table('sections as s')
                    ->leftJoin('users as u_officer', function($join) {
                        $join->on('s.officer_id', '=', 'u_officer.id')
                            ->where('u_officer.role', '=', 3);
                    })
                    ->leftJoin('users as u_staff', function($join) {
                        $join->on('s.staff_id', '=', 'u_staff.id')
                            ->where('u_staff.role', '=', 4);
                    })
                    ->select(
                        's.id as section_id',
                        's.name as section_name',
                        'u_officer.name as officer_name',
                        'u_officer.designation as officer_designation',
                        'u_staff.name as staff_name',
                        'u_staff.designation as staff_designation'
                    )
                    ->get();

        $officers = DB::table('users')
                    ->where('role', 3)
                    ->where('is_deleted', 0)
                    ->get(['id', 'name', 'designation']);

        $staffs = DB::table('users')
                    ->where('role', 4)
                    ->where('is_deleted', 0)
                    ->get(['id', 'name', 'designation']);



        return view('sections.index', compact('sections', 'officers', 'staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'officer_id' => 'nullable|integer',
            'staff_id' => 'nullable|integer',
        ]);

        // Create a new section entry
        $section = Section::create([
            'name' => $validatedData['name'],
            'officer_id' => $validatedData['officer_id'],
            'staff_id' => $validatedData['staff_id'],
        ]);

        // Section::create($request);

        return redirect()->back()->with('success', 'শাখাটি সফলভাবে যুক্ত হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display AJAX requests
     */
    public function fetch(string $id)
    {
        $section = Section::findOrFail($id);

        return $section;
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
    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // 'id'    => 'integer|exists:id',
            'name' => 'required|string|max:255',
            'officer_id' => 'nullable|integer',
            'staff_id' => 'nullable|integer',
        ]);

        // Create a new section entry
        $section = Section::findOrFail($request->id)->update([
            'name' => $validatedData['name'],
            'officer_id' => $validatedData['officer_id'],
            'staff_id' => $validatedData['staff_id'],
        ]);

        // Section::create($request);

        return redirect()->back()->with('success', 'শাখাটি সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
