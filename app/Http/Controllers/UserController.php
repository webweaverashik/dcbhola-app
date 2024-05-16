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

        return view('users.index', compact('officers', 'staffs', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    public function addOfficer(Request $request)
    {
        $request->validate([
            'photo_url'     => 'nullable|mimes:jpg,png,jpeg,webp|max:100',
            'name'          => 'required|min:5|max:100|string',
            'designation'   => 'required|string',
            'phone'         => 'required|string',
            'email'         => 'required|email',
        ]);

        if ($request->has('photo_url')) 
        {
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            

            $filename = 'photo_' . time() . '.' . $extension;

            
            $path = 'uploads/photo/';
            $image->move($path, $filename);

            User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role'          => 2,
                'password'      => bcrypt('12345678'),
                'designation'   => $request->designation,
                'photo_url'     => $path.$filename
            ]);
        } 
        else
        {
            User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role'          => 2,
                'password'      => bcrypt('12345678'),
                'designation'   => $request->designation,
            ]);
        }

        return redirect()->back()->with('success', 'কর্মকর্তা সফলভাবে যুক্ত হয়েছে।');
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'photo_url'     => 'nullable|mimes:jpg,png,jpeg,webp|max:100',
            'name'          => 'required|min:5|max:100|string',
            'designation'   => 'required|string',
            'phone'         => 'required|string',
            'email'         => 'required|email',
            'role'          => 'required|string',
        ]);

        
        // Staff Type setting
        if ($request->role == '3')
            $role = 3;
        elseif ($request->role == '4')
            $role = 4;
        else
            $role = 3;


        if ($request->has('photo_url')) 
        {
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            

            $filename = 'photo_' . time() . '.' . $extension;

            
            $path = 'uploads/photo/';
            $image->move($path, $filename);

            User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role'          => $role,
                'password'      => bcrypt('12345678'),
                'designation'   => $request->designation,
                'photo_url'     => $path.$filename
            ]);
        } 
        else
        {
            User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role'          => $role,
                'password'      => bcrypt('12345678'),
                'designation'   => $request->designation,
            ]);
        }

        return redirect()->back()->with('success', 'কর্মচারী সফলভাবে যুক্ত হয়েছে।');
    }

    
    public function ajaxUserInfo(string $id)
    {
        $user = User::findOrFail($id);
        return $user;
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

            User::findOrFail($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'designation'=> $request->designation,
                'photo_url' => $path.$filename
            ]);

            session()->put('photo_url', $path.$filename);
        } 
        else
        {
            $path = NULL;
            $filename = NULL;

            User::findOrFail($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'designation'=> $request->designation,
                // 'photo_url' => $path.$filename
            ]);
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


    public function updateOfficer(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:100|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'designation' => 'required|string',
        ]);

        User::findOrFail($request->id)->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'designation'   => $request->designation,
        ]);

        return redirect()->back()->with('success', 'কর্মকর্তার প্রোফাইল সফলভাবে আপডেট হয়েছে।');
    }
    public function updateStaff(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:5|max:100|string',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'designation'   => 'required|string',
            'role'          => 'required|string',
        ]);

        // Staff Type setting
        if ($request->role == '3')
            $role = 3;
        elseif ($request->role == '4')
            $role = 4;
        else
            $role = 3;

        User::findOrFail($request->id)->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'designation'   => $request->designation,
            'role'          => $role,
        ]);

        if ($role == 4) {
            Section::where('staff_id', $request->id)->update(['staff_id' => NULL]);
        }

        return redirect()->back()->with('success', 'কর্মচারির প্রোফাইল সফলভাবে আপডেট হয়েছে।');
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
