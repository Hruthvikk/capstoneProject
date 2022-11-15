<?php

namespace App\Http\Controllers;

use App\Models\editStyle;
use App\Models\mealTime;
use App\Models\occasion;
use App\Models\occasions;
use App\Models\recipe;
use App\Models\recipes;
use App\Models\userRoles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Psy\Readline\Hoa\Console;

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
        $user=userRoles::all();
        
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle,
            'user'=>$user
            
        ];
        return view('addrecipe')->with($params);
    }

    public function searchRecipeView(){
        $eatingstyle=editStyle::all();
        $mealtime=mealTime::all();
        $occasions=occasion::all();
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle
        ];
        return view('searchrecipe')->with($params);
    }

    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addrecipep(Request $request)
    {
        $request->validate([
            'recipename'=>'required',
            'preparationtime' =>'required  |numeric',
            'cookingtime'=>'required |numeric',
            'eatingstyle'=>'required',
            'occasion'=>'required',
            'mealtime'=>'required',
            'recipeimage'=>'required',
            'ingredients'=>'required',
            'steps'=>'required'
        ]);

        
        $recipeimage = $request->file('recipeimage')->getClientOriginalName();
        // $request->file('recipeimage')->storeAs('public/images/',$recipeimage);
        $request->file('recipeimage')->move(public_path('public/Image'), $recipeimage);
        
        $newrecipe = new recipes();
        
        $newrecipe->recipeName = $request->recipename;
        $newrecipe->recipeDescription = $request->recipedescription;
        $newrecipe->preparationTime = $request->preparationtime;
        $newrecipe->cookingTime = $request->cookingtime;
        $newrecipe->ingredients = $request->ingredients;
        $newrecipe->steps = $request->steps;
        $newrecipe->user_id = $request->user_id;
        $newrecipe->recipeImage = $recipeimage;
        $newrecipe->mealTime_id = $request->mealtime;
        $newrecipe->editStyle_id = $request->eatingstyle;
        $newrecipe->occasion_id = $request->occasion;

        $res=$newrecipe->save();
        
        if($res){
            return back()->with('success1','New Recipe Added Successfully');
        }
        else{
            return back()->with('fail1','New Recipe add Unsuccessful');
        }
    }

    public function searchRecipe(Request $request){
            $mtid[] = $request->mealtime;
            $esid[] = $request->eatingStyle;
            $oid[] = $request->occasion;
            
            $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)
                             ->orwhere('editStyle_id','=',$esid)
                             ->orwhere('occasion_id','=',$oid)->get();
            return view('searchedrecipes',['mtres'=>$mtres]);
            
    }
    public function viewrecipe($id)
    {
        $recipedata = recipes::where('id',$id)->get();
        return view('viewrecipe',compact('recipedata'));
    }
    public function viewrecipesteps($id)
    {
        $recipestepdata = recipes::where('id',$id)->get();
        return view('recipesteps',compact('recipestepdata'));
    }
    public function displayallRecipe(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->get();
        return view('admindar',['dar'=>$displayar]);
    }
    public function deleteRecipe($id){
        DB::delete('delete from recipes where id = ?',[$id]);
        $displayar =  DB::table('recipes')
        ->join('user_roles', 'recipes.user_id','=','user_roles.id')
        ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
        ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
        ->join('occasions', 'recipes.occasion_id','=','occasions.id')
        ->get();
        return view('admindar',['dar'=>$displayar]);
    }

    

}
