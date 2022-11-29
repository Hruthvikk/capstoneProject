<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\userRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Psy\Readline\Hoa\Console;

class homeafterlogin extends Controller
{
    public function index()
    {
        $user = userRoles::all(); 
        return view('homeafterlogin',['user'=>$user]);
    }
    public function editp(Request $request)
    {
        $uid=$request->session()->get('loginUserId');
        $editr = DB::table('recipes')
                    ->where('user_id','=',$uid)
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->get();
        return view('editProfile',['editr'=>$editr]);

    }
    public function aeditp($aid)
    {
        $userdata=userRoles::find($aid);
        return view('adminEP',['userdata'=>$userdata]);
    }
    public function editp1($id)
    {
        $userdata=userRoles::find($id);   
        return view('editUserProfile',compact('userdata'));
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
    public function viewfavourites(Request $request){
        $userloginid = $request->session()->get('loginUserId');
        $userFavourites = DB::table('rating_favs')->join('recipes', 'rating_favs.recipe_id','=','recipes.id')
                                                  ->where('favYesNo','=','yes')
                                                  ->where('rating_favs.user_id','=',$userloginid)
                                                  ->get();
        return view('viewfavourites',['userFavourites'=>$userFavourites]);
    }

//------------------------------ADMIN---------------------------------------------------------------
    public function displayallUser(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userFirstName', 'asc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }

    public function displayUserWithDate(Request $request){
        $fromDate = $request->fromDate;
        
        $toDate = $request->toDate;
        

        $displayau = userRoles::whereRaw("created_at >= ? AND created_at <= ?",[$fromDate." 00:00:00",$toDate." 23:59:59"])->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function displayallUserdes(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userFirstName', 'desc')->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function displayallUserlndes(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userLastName', 'desc')->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function displayallUserelnasc(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userLastName', 'asc')->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function displayallUseremasc(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userEmail', 'asc')->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function displayallUseremdes(){
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->orderBy('userEmail', 'desc')->get();
        return view('admindalu',['dau'=>$displayau]);
    }
    public function deleteUser($id){
        DB::delete('delete from user_roles where id = ?',[$id]);
        $mem="member";
        $displayau = userRoles::where('userType',$mem)->get();
        return back();
    }

//---------------------------------------END ADMIN---------------------------------------------------



    

}
