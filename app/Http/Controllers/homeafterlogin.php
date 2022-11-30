<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\userRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Psy\Readline\Hoa\Console;

class homeafterlogin extends Controller
{
    // This is function to display home page after login
    public function index()
    {
        $user = userRoles::all();
        return view('homeafterlogin', ['user' => $user]);
    }
    // This is function to display edit profile page with recipes added by user
    // which is logged in
    public function editp(Request $request)
    {
        $uid = $request->session()->get('loginUserId');
        $editr = DB::table('recipes')
            ->where('user_id', '=', $uid)
            ->join('user_roles', 'recipes.user_id', '=', 'user_roles.id')
            ->join('meal_times', 'recipes.mealTime_id', '=', 'meal_times.id')
            ->join('edit_styles', 'recipes.editStyle_id', '=', 'edit_styles.id')
            ->join('occasions', 'recipes.occasion_id', '=', 'occasions.id')
            ->select('recipes.*', 'user_roles.userFirstName', 'meal_times.mealTimeName', 'edit_styles.editStyleName', 'occasions.occassionName')
            ->get();
        return view('editProfile', ['editr' => $editr]);
    }
    // This is function to display edit profile page for admin
    public function aeditp($aid)
    {
        $userdata = userRoles::find($aid);
        return view('adminEP', ['userdata' => $userdata]);
    }
    // This is function to display edit profile page for member
    public function editp1($id)
    {
        $userdata = userRoles::find($id);
        return view('editUserProfile', compact('userdata'));
    }
    // This is function to update member profile
    public function updatep1(Request $request, $uid)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|unique:user_roles,userEmail',
            'phonenumber' => 'required |numeric |digits:10'
        ]);
        $up = userRoles::find($uid);

        $up->userEmail = $request->email;
        $up->userPhoneNumber = $request->phonenumber;
        $up->save();
        return back()->with('success2', 'PROFILE UPDATED');
    }
    // This is function to update admin profile
    public function aupdatep1(Request $request, $uid)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|unique:user_roles,userEmail',
            'phonenumber' => 'required |numeric |digits:10'
        ]);
        $up = userRoles::find($uid);

        $up->userEmail = $request->email;
        $up->userPhoneNumber = $request->phonenumber;
        $up->save();
        return back()->with('success2', 'PROFILE UPDATED');
    }
    // This is function to display about us page after login
    public function aual()
    {
        return view('aboutusal');
    }
    // This is function to display recipes which are user's favourite
    public function viewfavourites(Request $request)
    {
        $userloginid = $request->session()->get('loginUserId');
        $userFavourites = DB::table('rating_favs')->join('recipes', 'rating_favs.recipe_id', '=', 'recipes.id')
            ->where('favYesNo', '=', 'yes')
            ->where('rating_favs.user_id', '=', $userloginid)
            ->get();
        return view('viewfavourites', ['userFavourites' => $userFavourites]);
    }

    //------------------------------ADMIN---------------------------------------------------------------

    // This is function to display all signed up users to admin
    public function displayallUser()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userFirstName', 'asc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to display
    public function displayUserWithDate(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $displayau = userRoles::whereRaw("created_at >= ? AND created_at <= ?", [$fromDate . " 00:00:00", $toDate . " 23:59:59"])->paginate(5);
        $data = compact('displayau');
        return back()->with($data);
    }
    // This is function to display all users in descending order by First Name
    public function displayallUserdes()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userFirstName', 'desc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to display all users in descending order by Last Name
    public function displayallUserlndes()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userLastName', 'desc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to display all users in ascending order by Last Name
    public function displayallUserelnasc()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userLastName', 'asc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to display all users in ascending order by Email
    public function displayallUseremasc()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userEmail', 'asc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to display all users in descending order by Email
    public function displayallUseremdes()
    {
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->orderBy('userEmail', 'desc')->paginate(5);
        $data = compact('displayau');
        return view('admindalu')->with($data);
    }
    // This is function to delete user on admin side
    public function deleteUser($id)
    {
        DB::delete('delete from user_roles where id = ?', [$id]);
        $mem = "member";
        $displayau = userRoles::where('userType', $mem)->get();
        return back();
    }

    //---------------------------------------END ADMIN---------------------------------------------------
}
