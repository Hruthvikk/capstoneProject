<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userrole;
use App\Models\userRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class signup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('signup');
    }
    public function registerUser(Request $request){
        $request->validate([
            'firstname'=>'required',
            'lastname' =>'required',
            'email'=>'required|email:rfc,dns|unique:user_roles,userEmail',
            'phonenum'=>'required | max:12',
            'password'=> [
                'required',
                'string',
                'min:10',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*#?&]/', 
            ],
            'confirmpassword'=>[
                'required',
                'string',
                'min:10',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*#?&]/', 
            ]
        ]);
        $user = new userRoles();
        $user->userFirstName = $request->firstname;
        $user->userLastName = $request->lastname;
        $user->userEmail = $request->email;
        $user->userType = "member";
        $user->userPhoneNumber = $request->phonenum;
        if($request->password === $request->confirmpassword){
            $user->userPassword = Hash::make($request->password);
        }
        $res=$user->save();
        if($res){
            return back()->with('success','You are Registered Successfully');
        }
        else{
            return back()->with('fail','Registration Unsuccessful');
        }
    }
}
