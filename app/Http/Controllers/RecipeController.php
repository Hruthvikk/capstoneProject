<?php

namespace App\Http\Controllers;

use App\Models\editStyle;
use App\Models\mealTime;
use App\Models\occasion;
use App\Models\occasions;
use App\Models\recipe;
use App\Models\recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eatingstyle=editStyle::all();
        $mealtime=mealTime::all();
        $occasions=occasion::all();
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle
        ];
        return view('addrecipe')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'recipename'=>'required',
            'preparationtime' =>'required  |numeric',
            'cookingtime'=>'required |numeric',
            'eatingstyle'=>'required',
            'occasion'=>'required',
            'recipeimage'=>'required',
            'ingredients'=>'required',
            'steps'=>'required'
        ]);

        
        $imgname=$request->file('recipeimage')->getClientOriginalName();

        $request->file('recipeimage')->storeAs('public/images/',$imgname);
        
        $newrecipe = new recipes();
        $newrecipe->recipeName = $request->recipename;
        $newrecipe->recipeDescription = $request->recipedescription;
        $newrecipe->preparationTime = $request->preparationtime;
        $newrecipe->cookingTime = $request->cookingtime;
        $newrecipe->recipeImage = $imgname;
        $newrecipe->ingredients = $request->ingredients;
        $newrecipe->steps = $request->steps;

        $res=$newrecipe->save();
        if($res){
            return back()->with('success','New Recipe Added Successfully');
        }
        else{
            return back()->with('fail','New Recipe add Unsuccessful');
        }
        
    }

    

}
