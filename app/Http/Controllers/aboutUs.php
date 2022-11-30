<?php

namespace App\Http\Controllers;

use App\Models\ratingFav;
use App\Models\recipes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class aboutUs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('aboutus');
    }
    public function homeindex()
    {
        $b=DB::table('recipes')->select('id')->where('mealTime_id','=',1)->limit(1)->first();
                        $l=DB::table('recipes')->select('id')->where('mealTime_id','=',2)->limit(1)->first();
                        $d=DB::table('recipes')->where('mealTime_id','=',3)->limit(1)->first();
                        $rndrec = recipes::inRandomorder()
                        ->where('id','!=',$b->id)->where('id','!=',$l->id)->where('id','!=',$d->id)->orWhereNull('id')
                        ->limit(3)->get();
                        $brkfst = recipes::where('mealTime_id','=',1)->limit(1)->get();
                        $lunch = recipes::where('mealTime_id','=',2)->limit(1)->get();
                        $dine = recipes::where('mealTime_id','=',3)->limit(1)->get();
                        $params = [
                            'rndrec'=>$rndrec,
                            'brkfst'=>$brkfst,
                            'lunch' =>$lunch,
                            'dine' =>$dine
                        ];
        return view('home')->with($params);
    }
    public function tantindex(){
        return view('tant');
    }

}
