<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = User::where('role', 2)->get();
        $staffs = User::whereIn('role', [3, 4])->get();

        // return $staffs;

        return view('users.index', compact('officers', 'staffs'));
    }

    public function show()
    {
        $profile = User::where('id','=', Session::get('loginId'))->first();
        return view('users.profile', compact('profile'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $id = session('loginId');
        
        $profile = User::findOrFail($id);
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
            'phone' => 'required|string',
            'designation' => 'required|string',
            'photo_url' => 'nullable|mimes:jpg,png,jpeg,webp|max:100'
        ]);


        $user = User::findOrFail($id);

        if ($request->has('photo_url')) 
        {
            $image = $request->file('photo_url');
            $extension = $image->getClientOriginalExtension();
            

            $filename = time() . '.' . $extension;

            
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
        else {
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
}
