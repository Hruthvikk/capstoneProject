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
        
        return view('home');
    }
    public function tantindex(){
        return view('tant');
    }

}
