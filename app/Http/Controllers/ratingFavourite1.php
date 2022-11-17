<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ratingFav;

class ratingFavourite1 extends Controller
{
    public function raterecipe(Request $request){
        $new_raterecipe = new ratingFav();

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
