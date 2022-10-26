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
            'email'=>'required|email|unique:user_roles',
            'phonenum'=>'required | max:12',
            'password'=>'required | min:4 | max:24',
            'confirmpassword'=>'required | min:4 | max:24'
        ]);
        $user = new userRoles();
        $user->userFirstName = $request->firstname;
        $user->userLastName = $request->lastname;
        $user->userEmail = $request->email;
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
