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
use Rakibhstu\Banglanumber\NumberToBangla;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = User::whereIn('role', [2, 3])->where('is_deleted', 0)->get();
        $staffs = User::where('role', 4)->where('is_deleted', 0)->get();

        // Create an instance of the NumberToBangla class
        $numToBangla = new NumberToBangla();

        // Iterate over each student and convert phone numbers, birth date, and created_at to Bangla for frontend display
        $officers->transform(function ($officer) use ($numToBangla) {
            $officer->created_at_bn = $this->convertDateTimeToBangla($officer->created_at, $numToBangla);
            
            return $officer;
        });

        $staffs->transform(function ($staff) use ($numToBangla) {
            $staff->created_at_bn = $this->convertDateTimeToBangla($staff->created_at, $numToBangla);
            
            return $staff;
        });


        $sections = Section::get();

        return view('users.index', compact('officers', 'staffs', 'sections'));
    }



    private function convertDateTimeToBangla($dateTime, $numToBangla)
    {
        // Extract date components
        $year = $numToBangla->bnNum($dateTime->format('Y'));
        $month = $numToBangla->bnNum($dateTime->format('m'));
        $day = $numToBangla->bnNum($dateTime->format('d'));
        $hourB = $numToBangla->bnNum($dateTime->format('h'));
        $minute = $numToBangla->bnNum($dateTime->format('i'));
        $second = $numToBangla->bnNum($dateTime->format('s'));

        $hour = date("H", strtotime($dateTime));
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

    /**
     * Reset user password from admin interface
     */
    public function passwordReset(Request $request)
    {
        $request->validate([
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        // return bcrypt($request->password);

        User::findOrFail($request->id)->update([
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

        $user = User::findOrFail($id);
        
        if ($user->role == 2) {
            Section::where('officer_id', $id)->update([
               'officer_id' => NULL
            ]);
        }
        elseif ($user->role == 3) {
            Section::where('staff_id', $id)->update([
               'staff_id' => NULL
            ]);
        }
        
        return redirect()->back()->with('success', 'ইউজার সফলভাবে ডিলিট হয়েছে।');
    }
}
