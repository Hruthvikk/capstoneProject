<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ratingFav;

class ratingFavourite1 extends Controller
{
    // This is function to RATE RECIPES
    public function raterecipe(Request $request)
    {
        $userloginid = $request->session()->get('loginUserId');
        $currentRecipeId = $request->recipe_id;
        $alreadyexists = DB::table('rating_favs')->select('starNum')->where('recipe_id', '=', $currentRecipeId)->where('user_id', '=', $userloginid);
        $alreadyexistsCount = $alreadyexists->count();
        $alreadyexistsstarnum = DB::table('rating_favs')->select('starNum')->where('user_id', '=', $userloginid)->where('recipe_id', '=', $currentRecipeId);
        $inputStarNum = $request->input('rate');

        if ($alreadyexistsCount == 0) {
            $new_raterecipe = new ratingFav();
            $new_raterecipe->starNum = $request->input('rate');
            $new_raterecipe->favYesNo = $request->input('fav');
            $new_raterecipe->user_id = $request->user_id;
            $new_raterecipe->recipe_id = $request->recipe_id;
            $res = $new_raterecipe->save();
            if ($res) {
                return back()->with('alreadyexists', '1');
            }
        } else if ($alreadyexistsCount == 1) {
            if ($alreadyexistsstarnum == $inputStarNum) {
                return back()->with('alreadyexists', 'You Already have same Rating.');
            } else {
                $updateRating = ratingFav::where('recipe_id', '=', $currentRecipeId)->where('user_id', '=', $userloginid)->where('recipe_id', '=', $currentRecipeId)
                    ->update([
                        'starNum' => $request->rate,
                        'favYesNo' => $request->fav
                    ]);
                if ($updateRating) {
                    return back()->with('alreadyexists', '2');
                }
            }
        }
    }
}
