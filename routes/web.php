<?php

use App\Http\Controllers\aboutUs;
use App\Http\Controllers\homeafterlogin;
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
Route::get('/searchrecipe', function () {
    return view('searchrecipe');
});
Route::get('/viewrecipe', function () {
    return view('viewrecipe');
});
Route::get('/editProfile', function () {
    return view('editProfile');
});
Route::get('/homeafterlogin', [homeafterlogin::class,'index'])->middleware('isLoggedIn');
Route::get('/aboutus',[aboutUs::class,'index']);
Route::get('/signin',[signin::class,'indexview'])->middleware('alreadyLoggedIn');
Route::post('/login-user',[signin::class,'loginUser'])->name('login-user');
Route::get('/signup',[signup::class,'index'])->name('reg')->middleware('alreadyLoggedIn');
Route::post('/register-user',[signup::class,'registerUser'])->name('register-user');
Route::get('/logout',[signin::class,'logout']);