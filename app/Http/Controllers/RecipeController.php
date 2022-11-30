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
            $mtid[] = $request->mealtime;
            $esid[] = $request->eatingStyle;
            $oid[] = $request->occasion;
            if($request->mealtime)
            {
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)->get();
                return view('searchedrecipes',['mtres'=>$mtres]);
            }else if($request->eatingStyle)
            {
                $mtres = DB::table('recipes')
                ->where('editStyle_id','=',$esid)
                ->get();
            }else if($request->occasion){
                $mtres = DB::table('recipes')
                ->where('occasion_id','=',$oid)->get();
            }else if($request->mealtime && $request->eatingStyle){
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)
                ->where('editStyle_id','=',$esid)
                ->first();
            }else if($request->mealtime && $request->occasion){
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)
                ->where('occasion_id','=',$oid)->first();
            }else if($request->eatingStyle && $request->occasion){
                $mtres = DB::table('recipes')
                ->where('editStyle_id','=',$esid)
                ->where('occasion_id','=',$oid)->first();
            }else if($request->eatingStyle && $request->mealtime && $request->occasion){
                $mtres = DB::table('recipes')->where('mealTime_id','=',$mtid)
                ->where('editStyle_id','=',$esid)
                ->where('occasion_id','=',$oid)->first();
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
    

    public function updateRecipe($recipename){
        $eatingstyle=editStyle::all();
        $mealtime=mealTime::all();
        $occasions=occasion::all();
        $uprecipeData = recipes::where('recipeName','=',$recipename)->get();
        $params=[
            'mealtime'=>$mealtime,
            'occasions'=>$occasions,
            'eatingstyle'=>$eatingstyle,
            'uprecipeData'=>$uprecipeData
        ];
        
        return view('updateRecipe',['uprecipeData'=>$uprecipeData])->with($params);
    }



    public function displayallRecipe(){
        $displayar = DB::table('recipes')
                    ->join('user_roles', 'recipes.user_id','=','user_roles.id')
                    ->join('meal_times', 'recipes.mealTime_id','=','meal_times.id')
                    ->join('edit_styles', 'recipes.editStyle_id','=','edit_styles.id')
                    ->join('occasions', 'recipes.occasion_id','=','occasions.id')
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

    
    

}
