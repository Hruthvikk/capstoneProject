<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ratingFav;

class ratingFavourite1 extends Controller
{
    public function raterecipe(Request $request){
        $current_uid = $request->session()->get('loginUserId') ;
        $query = "SELECT rating_favs.starNum FROM rating_favs where user_id=$current_uid";
        $csn = DB::select($query);
        $new_raterecipe = new ratingFav();
        if( ( $csn = $request->input('rate') )&& ($new_raterecipe->user_id = $request->user_id)){
            return back()->with('alreadyexists','Same rating already Exists');    
        }
        else{

                $new_raterecipe->starNum = $request->input('rate');
                $new_raterecipe->favYesNo = $request->input('fav');
                $new_raterecipe->user_id = $request->user_id;
                $new_raterecipe->recipe_id = $request->recipe_id;
                $res = $new_raterecipe->save();
                if($res){
                return back();
                }
        }
    
    }
}
