<?php

namespace App\Http\Controllers;

use App\Models\userRoles;
use Illuminate\Http\Request;

class homeafterlogin extends Controller
{
    public function index()
    {
        $user = userRoles::all(); 
        return view('homeafterlogin',['user'=>$user]);
    }
    public function editp()
    {
        return view('editProfile');
    }
    public function editp1($id)
    {
        $userdata=userRoles::find($id);
        return view('editUserProfile',['userdata'=>$userdata]);
    }
    public function updatep1(Request $request,$uid){
        $up = userRoles::find($uid);
        $up->userEmail = $request->email;
        $up->userPhoneNumber = $request->phonenumber;
        $up->save();
        return back()->with('success2','PROFILE UPDATED');
    }
    public function aual(){
        return view('aboutusal');
    }


}
