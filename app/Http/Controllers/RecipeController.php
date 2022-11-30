<?php

namespace App\Http\Controllers;

use App\Models\editStyle;
use App\Models\mealTime;
use App\Models\occasion;
use App\Models\unit;
use App\Models\recipes;
use App\Models\userRoles;
use App\Models\ratingFav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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
        $unit=unit::all();
        $user=userRoles::all();
        
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle,
            'user'=>$user,
            'unit'=>$unit
            
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
            'eatingstyle'=>$eatingstyle,
            

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
            'steps'=>'required',
        ]);
        $input=$request->all();
        
        $measurements=$input['measurement'];
        $measurements1=implode(',',$measurements);
        $units=$input['unit'];
        $units1=implode(',',$units);
        $ingredients=$input['ingredients'];
        $ingredients1=implode(',',$ingredients);
        
        $recipeimage = $request->file('recipeimage')->getClientOriginalName();
         
        //  $request->file('recipeimage')->storeAs('public/images',$recipeimage);
         $path=$request->file('recipeimage')->store('images','s3');

        // Storage::disk('s3')->put($recipeimage,'public');
        Storage::disk('s3')->setVisibility($path,'public');
          
        // $request->file('recipeimage')->move(public_path('/storage/app/public/Image'), $recipeimage);
        
        $newrecipe = new recipes();

        $newrecipe->recipeName = $request->recipename;
        $newrecipe->recipeDescription = $request->recipedescription;
        $newrecipe->preparationTime = $request->preparationtime;
        $newrecipe->cookingTime = $request->cookingtime;
        $newrecipe->ingredients = $ingredients1;
        $newrecipe->steps = $request->steps;
        $newrecipe->user_id = $request->user_id;
        $newrecipe->recipeImage = basename($path) ;
        $newrecipe->mealTime_id = $request->mealtime;
        $newrecipe->editStyle_id = $request->eatingstyle;
        $newrecipe->occasion_id = $request->occasion;
        $newrecipe->unitName = $units1;
        $newrecipe->measurement = $measurements1;

        $res=$newrecipe->save();
        
        if($res){
            return back()->with('success1','New Recipe Added Successfully');
        }
        else{
            $request->session()->put('fail1','New Recipe add Unsuccessful');
            return view('homeafterlogin')->with('fail1','New Recipe add Unsuccessful');
        }
    }

    public function searchRecipe(Request $request){
            $mtid = $request->mealtime;
            $esid = $request->eatingstyle;
            $oid = $request->occasion;

            if(!$mtid && !$esid && !$oid){
                return back()->with('notsel','Please Select Radio Button');
            }
            else if($esid && $mtid && $oid)
            {
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)->where('editStyle_id','=',$esid)->where('occasion_id','=',$oid)->first();
                
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('mealTime_id','=',$mtid)->where('editStyle_id','=',$esid)->where('occasion_id','=',$oid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($mtid && $esid)
            {
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)->where('editStyle_id','=',$esid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('mealTime_id','=',$mtid)->where('editStyle_id','=',$esid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($mtid && $oid)
            {
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)->where('occasion_id','=',$oid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 =  DB::table('recipes')->where('mealTime_id','=',$mtid)->where('occasion_id','=',$oid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($esid && $oid)
            {
                $mtres = DB::table('recipes')->where('editStyle_id','=',$esid)->where('occasion_id','=',$oid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('editStyle_id','=',$esid)->where('occasion_id','=',$oid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($mtid)
            {
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('mealTime_id','=',$mtid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($esid)
            {
                $mtres = DB::table('recipes')->where('editStyle_id','=',$esid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('editStyle_id','=',$esid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            else if($oid)
            {
                $mtres = DB::table('recipes')->where('occasion_id','=',$oid)->first();
                if( $mtres == null )
                {
                    return back()->with('notsel','NO RECIPES UNDER THAT FILTER');
                }
                else if($mtres != null)
                {
                    $mtres1 = DB::table('recipes')->where('occasion_id','=',$oid)->get();
                    return view('searchedrecipes',['mtres1'=>$mtres1]);
                }
            }
            
    }
    public function viewrecipe(Request $request,$id)
    {
        
        $recipedata = recipes::where('id',$id)->get();

        $fivestarlist = ratingFav::where('recipe_id','=',$id)
                                  ->where('starNum','=','5')->get();
        $fivestarcount = $fivestarlist->count();

        $fourstarlist = ratingFav::where('recipe_id','=',$id)
                                ->where('starNum','=','4')->get();
        $fourstarcount = $fourstarlist->count();

        $threestarlist = ratingFav::where('recipe_id','=',$id)->where('starNum','=','3')->get();
        $threestarcount = $threestarlist->count();

        $twostarlist = ratingFav::where('recipe_id','=',$id)->where('starNum','=','2')->get();
        $twostarcount = $twostarlist->count();

        $onestarlist = ratingFav::where('recipe_id','=',$id)->where('starNum','=','1')->get();
        $onestarcount = $onestarlist->count();

        $allstarlist = ratingFav::select('starNum')->where('recipe_id','=',$id);
        $allstarcount = $allstarlist->count();

        $uid=$request->session()->get('loginUserId');
        $arf = ratingFav::where('user_id','=',$uid)->where('recipe_id','=',$id)->get();
        
        $params=[
            'fives'=>$fivestarcount,
            'fours'=>$fourstarcount,
            'threes'=>$threestarcount,
            'twos'=>$twostarcount,
            'ones'=>$onestarcount,
            'allstar'=>$allstarcount,
            'arf'=>$arf
        ];
        return view('viewrecipe',compact('recipedata'))->with($params);
    }
    public function viewrecipesteps($id)
    {
        $recipestepdata = recipes::where('id',$id)->get();
        return view('recipesteps',compact('recipestepdata'));
    }
    

    public function updateRecipe($id){
        $eatingstyle=editStyle::all();
        $mealtime=mealTime::all();
        $occasions=occasion::all();
        
        $uprecipeData =  DB::table('recipes')->where('recipes.id','=',$id)
        ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
        ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
        ->join('occasions', 'recipes.occasion_id','=','occasions.id')
        ->select('recipes.*','meal_times.mealTimeName','edit_styles.editStyleName','occasions.occassionName')->get();
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle,
            'uprecipeData'=>$uprecipeData
            
        ];
        
        return view('updateRecipe',['uprecipeData'=>$uprecipeData])->with($params);
    }
    public function updaterecipep(Request $request){
        $rid = $request->rid;
        $rimg = $request->recipeimage;
        $rimg1 = Str::length($rimg);
        $upr = recipes::find($rid);
        if($rimg1 > 1) {
            $path=$request->file('recipeimage')->store('images','s3');
            Storage::disk('s3')->setVisibility($path,'public');
            $upr->recipeImage = basename($path) ;
        }
        $upr->recipeName = $request->recipename;
        $upr->recipeDescription = $request->recipedescription;
        $upr->preparationTime = $request->preparationtime;
        $upr->cookingTime = $request->cookingtime;
        // $upr->ingredients = $ingredients1;
        $upr->steps = $request->steps;
        
        $upr->mealTime_id = $request->mealtime;
        $upr->editStyle_id = $request->eatingstyle;
        $upr->occasion_id = $request->occasion;
        $upr1=$upr->save();
        if($upr1){
            return back()->with('successupre','RECIPE UPDATED SUCCESSFULLY');
        }
        else{
            return back()->with('unsuccessupre','RECIPE UPDATE UNSUCCESSFULLY');
        }
        
    }



    public function displayallRecipe(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->select('recipes.*','user_roles.userFirstName','meal_times.mealTimeName','edit_styles.editStyleName','occasions.occassionName')
                    ->orderBy('recipeName','asc')
                    ->paginate(5);
        $data = compact('displayar');
        return view('admindar')->with($data);
    }

    public function displayRecipeWithDate(Request $request){
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        
        $displayar = recipes::whereRaw("recipes.created_at >= ? AND recipes.created_at <= ?",[$fromDate." 00:00:00",$toDate." 23:59:59"])
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->paginate(5);
                    $data = compact('displayar');
                    return back()->with($data);
    }

    public function displayallRecipedesc(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->orderBy('recipeName','desc')
                    ->paginate(5);
                    $data = compact('displayar');
                    return view('admindar')->with($data);
    }
    public function displayallRecipeptasc(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->orderBy('preparationTime','asc')
                    ->paginate(5);
                    $data = compact('displayar');
                    return view('admindar')->with($data);
    }
    public function displayallRecipeptdesc(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->orderBy('preparationTime','desc')
                    ->paginate(5);
                    $data = compact('displayar');
                    return view('admindar')->with($data);
    }
    public function displayallRecipectasc(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->orderBy('cookingTime','asc')
                    ->paginate(5);
                    $data = compact('displayar');
                    return view('admindar')->with($data);
    }
    public function displayallRecipectdesc(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
                    ->orderBy('cookingTime','desc')
                    ->paginate(5);
                    $data = compact('displayar');
                    return view('admindar')->with($data);
    }
    public function deleteRecipe($id){
        $success=DB::delete('delete from recipes where id = ?',[$id]);
        if($success){
            return back()->with('successdel','Recipe Deleted Successfully');
        }
        else{
            return back()->with('faildel','Recipe Delete Unsuccessfully');
        }
    }
    
    public function infosteps($id)
    {
        $recipestepdata = recipes::where('id',$id)->get();
        return view('adminviewsteps',compact('recipestepdata'));
    }

    
    

}
