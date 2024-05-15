<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = User::where('role', 2)->where('is_deleted', 0)->get();
        $staffs = User::whereIn('role', [3, 4])->where('is_deleted', 0)->get();
        $sections = Section::get();

        // $officers = DB::table('users')
        //             ->join('sections', 'sections.officer_id', '=', 'users.id')
        //             ->select('users.*', 'sections.name as section_name')
        //             ->where('users.role', 2)
        //             ->where('users.is_deleted', 0)
        //             ->get();

        // $staffs = DB::table('users')
        //             ->join('sections', 'sections.staff_id', '=', 'users.id')
        //             ->select('users.*', 'sections.name as section_name')
        //             ->whereIn('users.role', [3,4])
        //             ->where('users.is_deleted', 0)
        //             ->get();

        // return $sections;

        return view('users.index', compact('officers', 'staffs', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $profile = User::where('id','=', Session::get('loginId'))->first();

        // return $profile;

        // return view('users.profile', compact('profile'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $id = session('loginId');
        
        $profile = User::findOrFail($id);

        // return  $profile;
        return view('users.profile', compact('profile'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = session('loginId');
        
        $request->validate([
            'name' => 'required|min:5|max:100|string',
            // 'email' => 'required|email',
            // 'password' => 'nullable|string|min:6',
            'phone' => 'required|string',
            'designation' => 'required|string',
            'photo_url' => 'nullable|mimes:jpg,png,jpeg,webp|max:100'
        ]);


        $user = User::findOrFail($id);

        if ($request->has('photo_url')) 
        {
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            

            $filename = 'photo_' . session('loginId') . '.' . $extension;

            
            $path = 'uploads/photo/';
            $image->move($path, $filename);

            if (File::exists($user->photo_url)) {
                File::delete($user->photo_url);
            }

            if ($request->has('password')) {
                User::findOrFail($id)->update([
                    'name' => $request->name,
                    // 'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'designation'=> $request->designation,
                    'photo_url' => $path.$filename
                ]);
            } else {
                User::findOrFail($id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'designation'=> $request->designation,
                    'photo_url' => $path.$filename
                ]);
            }

            session()->put('photo_url', $path.$filename);
        } 
        else {
            $path = NULL;
            $filename = NULL;


            if ($request->has('password')) {
                User::findOrFail($id)->update([
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'designation'=> $request->designation,
                    // 'photo_url' => $path.$filename
                ]);
            } else {
                User::findOrFail($id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'designation'=> $request->designation,
                    // 'photo_url' => $path.$filename
                ]);
            }
        }
        
        session()->put('name', $request->name);
        session()->put('designation', $request->designation);
        // session()->put('photo_url', $path.$filename);

        return redirect()->back()->with('success', 'প্রোফাইল সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Update loggedin user password
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        // return bcrypt($request->password);

        User::findOrFail(session('loginId'))->update([
            'password' =>  bcrypt($request->password)
        ]);

        return redirect()->back()->with('success', 'পাসওয়ার্ড সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->update([
            'is_deleted' => 1,
        ]);
        
        // DB::table('users')->where('id', $id)->update(['is_deleted' => 1]);

        return redirect()->back()->with('success', 'ইউজার সফলভাবে ডিলিট হয়েছে।');
    }
}
