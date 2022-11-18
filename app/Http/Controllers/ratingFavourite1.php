<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ratingFav;

class ratingFavourite1 extends Controller
{
    public function raterecipe(Request $request){
            $userloginid = $request->session()->get('loginUserId');
            $alreadyexists = DB::table('rating_favs')->where('user_id','=',$userloginid);

            $alreadyexistsstarnum = DB::table('rating_favs')->select('starNum')->where('user_id','=',$userloginid);
            $inputStarNum = $request->rate;

            if($alreadyexists){
                if($alreadyexistsstarnum == $inputStarNum ){
                    return back()->with('alreadyexists','You Already have same Rating.');
                }else{
                    $updateRating = ratingFav::where('user_id','=',$userloginid)
                                                ->update(['starNum'=>$request->rate,
                                                'favYesNo'=>$request->fav
                                                ]);
                                                
                    
                    return back();
                }    
            }
            else if(!$alreadyexists){
            $new_raterecipe = new ratingFav();
                $new_raterecipe->starNum = $request->input('rate');
                $new_raterecipe->favYesNo = $request->input('fav');
                $new_raterecipe->user_id = $request->user_id;
                $new_raterecipe->recipe_id = $request->recipe_id;
                $res = $new_raterecipe->save();
                if($res){return back();}
        }
    }
    
}

