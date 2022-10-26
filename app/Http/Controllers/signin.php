<?php

namespace App\Http\Controllers;

use App\Models\userRoles;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
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
            'userEmail'=>'required|email|unique:user_roles,userEmail',
            'password'=>'required|min:4|max:24',
        ]);
        $user = userRoles::where('userEmail', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->userPassword)){
                $request->session()->put('loginId',$user->id);
                return view('homeafterlogin');
            }else{
                return back()->with('fail','Password does not match');    
            }
        }
        else{
            return back()->with('fail','This email address is not registered');
        }
    }

    }
