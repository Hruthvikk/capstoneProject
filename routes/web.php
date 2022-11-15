<?php

use App\Http\Controllers\aboutUs;
use App\Http\Controllers\homeafterlogin;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\signin;
use App\Http\Controllers\signup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/recipesteps/{recipeid}',[RecipeController::class,'viewrecipesteps'])->middleware('isLoggedIn');
Route::get('/viewrecipe/{recipeid}',[RecipeController::class,'viewrecipe'])->middleware('isLoggedIn');
Route::put('/searchedrecipes',[RecipeController::class,'searchRecipe'])->name('searched-recipes')->middleware('isLoggedIn');
Route::get('/searchrecipe',[RecipeController::class,'searchRecipeView'])->middleware('isLoggedIn');
Route::put('/searchrecipe',[RecipeController::class,'searchRecipe'])->middleware('isLoggedIn');
Route::get('/aboutusal',[homeafterlogin::class,'aual'])->middleware('isLoggedIn');
Route::get('/admindalu',[homeafterlogin::class,'displayallUser'])->middleware('isLoggedIn');
Route::get('/deleteuser/{userid}',[homeafterlogin::class,'deleteUser'])->middleware('isLoggedIn');
Route::get('/admindar',[RecipeController::class,'displayallRecipe'])->middleware('isLoggedIn');
Route::get('/deleteRecipe/{userid}',[RecipeController::class,'deleteRecipe'])->middleware('isLoggedIn');
Route::get('/editProfile',[homeafterlogin::class,'editp'])->middleware('isLoggedIn');
Route::get('/aeditProfile/{userid}',[homeafterlogin::class,'aeditp'])->middleware('isLoggedIn');
Route::put('/aeditProfile/{userid}',[homeafterlogin::class,'aupdatep1'])->middleware('isLoggedIn');
Route::get('/editUserProfile/{userid}',[homeafterlogin::class,'editp1'])->middleware('isLoggedIn');
Route::put('/editUserProfile/{userid}',[homeafterlogin::class,'updatep1'])->middleware('isLoggedIn');
Route::get('/addrecipe',[RecipeController::class,'index'])->middleware('isLoggedIn');
Route::get('/adminView',[signin::class,'adminView'])->middleware('isLoggedIn');
Route::post('/added-recipe',[RecipeController::class,'addrecipep'])->middleware('isLoggedIn')->name('added-recipe');
Route::get('/adminhomeafterlogin', [homeafterlogin::class,'index'])->middleware('isLoggedIn');
Route::get('/homeafterlogin', [homeafterlogin::class,'index'])->middleware('isLoggedIn');
Route::get('/aboutus',[aboutUs::class,'index']);
Route::get('/signin',[signin::class,'indexview'])->middleware('alreadyLoggedIn');
Route::post('/login-user',[signin::class,'loginUser'])->name('login-user');
Route::get('/signup',[signup::class,'index'])->name('reg')->middleware('alreadyLoggedIn');
Route::post('/register-user',[signup::class,'registerUser'])->name('register-user');
Route::get('/logout',[signin::class,'logout']);