<?php

namespace App\Http\Controllers;

use App\Models\userRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class signin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexview()
    {
        return view("signin");
    }

    public function loginUser(Request $request){
        $request->validate([
            'userEmail'=>'required|email',
            'password'=>'required|min:4|max:24',
        ]);
        $user = userRoles::where('userEmail', '=', $request->userEmail)->first();
        if($user)
        {
            if($request->userEmail && $request->password)
            {
                if($user->userType == "admin")
                {
                    if(Hash::check($request->password, $user->userPassword))
                    {
                        $request->session()->put('loginUser',$user->userEmail);
                        $request->session()->put('loginUserId',$user->id);
                        $request->session()->put('loginUserType',$user->userType);
                        return view('adminhomeafterlogin');
                    }
                    else{
                        return back()->with('fail','Password does not match');    
                    }
                }
                else if($user->userType == "member")
                {
                    if(Hash::check($request->password, $user->userPassword))
                    {
                        $request->session()->put('loginUser',$user->userEmail);
                        $request->session()->put('loginUserId',$user->id);
                        
                        return view('homeafterlogin');
                    }
                    else
                    {
                        return back()->with('fail','Password does not match');    
                    }
                }
            }
        }
        else
        {
            return back()->with('fail','This email address is not registered');
        }
    
    
    }
    public function adminView(){
            return view("adminhomeafterlogin");
    }

    public function logout(Request $request)
    {
        if($request->session()->has('loginUser'))
        {
            $request->session()->forget('loginUser');
            return redirect('signin');
        }
    }

    }
