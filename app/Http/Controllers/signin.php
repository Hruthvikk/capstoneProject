<?php

namespace App\Http\Controllers;

use App\Models\userRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\recipes;
use Illuminate\Support\Facades\DB;

class signin extends Controller
{
    // This is function to display SIGN IN page
    public function indexview()
    {
        return view("signin");
    }

    // This is function to Log in user with recipes data
    public function loginUser(Request $request)
    {
        $request->validate([
            'userEmail' => 'required|email',
            'password' => 'required|min:4|max:24',
        ]);
        $user = userRoles::where('userEmail', '=', $request->userEmail)->first();
        if ($user) {
            if ($request->userEmail && $request->password) {
                if ($user->userType == "admin") {
                    if (Hash::check($request->password, $user->userPassword)) {
                        $request->session()->put('loginUser', $user->userEmail);
                        $request->session()->put('loginUserId', $user->id);
                        $request->session()->put('userRole', $user->userType);
                        return view('adminhomeafterlogin');
                    } else {
                        return back()->with('fail', 'Password does not match');
                    }
                } else if ($user->userType == "member") {
                    if (Hash::check($request->password, $user->userPassword)) {
                        $request->session()->put('loginUser', $user->userEmail);
                        $request->session()->put('loginUserId', $user->id);
                        $request->session()->put('userRole', $user->userType);
                        $b = DB::table('recipes')->select('id')->where('mealTime_id', '=', 1)->limit(1)->first();
                        $l = DB::table('recipes')->select('id')->where('mealTime_id', '=', 2)->limit(1)->first();
                        $d = DB::table('recipes')->where('mealTime_id', '=', 3)->limit(1)->first();
                        $rndrec = recipes::inRandomorder()
                            ->where('id', '!=', $b->id)->where('id', '!=', $l->id)->where('id', '!=', $d->id)->orWhereNull('id')
                            ->limit(3)->get();
                        $brkfst = recipes::where('mealTime_id', '=', 1)->limit(1)->get();
                        $lunch = recipes::where('mealTime_id', '=', 2)->limit(1)->get();
                        $dine = recipes::where('mealTime_id', '=', 3)->limit(1)->get();
                        $params = [
                            'rndrec' => $rndrec,
                            'brkfst' => $brkfst,
                            'lunch' => $lunch,
                            'dine' => $dine
                        ];
                        return view('homeafterlogin')->with($params);
                    } else {
                        return back()->with('fail', 'Password does not match');
                    }
                }
            }
        } else {
            return back()->with('fail', 'This email address is not registered');
        }
    }
    // This is function to display ADMIN'S HOMEPAGE
    public function adminView()
    {
        return view("adminhomeafterlogin");
    }

    // This is function to LOGOUT USER
    public function logout(Request $request)
    {

        if ($request->session()->has('loginUser')) {
            $request->session()->forget('loginUser');
            return redirect('signin');
        } else {
            return redirect('signin');
        }
    }
}
