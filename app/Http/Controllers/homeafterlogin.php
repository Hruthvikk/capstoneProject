<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\userRoles;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

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
    public function aeditp($aid)
    {
        $userdata=userRoles::find($aid);
        return view('adminEP',['userdata'=>$userdata]);
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
    public function aupdatep1(Request $request,$uid){
        $up = userRoles::find($uid);
        $up->userEmail = $request->email;
        $up->userPhoneNumber = $request->phonenumber;
        $up->save();
        return back()->with('success2','PROFILE UPDATED');
    }
    public function aual(){
        return view('aboutusal');
    }
    public function displayallUser(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function deleteUser($id){
        DB::delete('delete from user_roles where id = ?',[$id]);
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function viewfavourites(Request $request){
        $userloginid = $request->session()->get('loginUserId');
        $userFavourites = DB::table('rating_favs')->join('recipes', 'rating_favs.recipe_id','=','recipes.id')
                                                  ->where('favYesNo','=','yes')
                                                  ->where('rating_favs.user_id','=',$userloginid)
                                                  ->get();
        return view('viewfavourites',['userFavourites'=>$userFavourites]);
    }

}
