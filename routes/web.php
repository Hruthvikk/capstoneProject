<?php

use App\Http\Controllers\aboutUs;
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
Route::get('/homeafterlogin', function () {
    return view('homeafterlogin');
});
Route::get('/aboutus',[aboutUs::class,'index']);
Route::get('/signin',[signin::class,'indexview']);
Route::post('/login-user',[signin::class,'loginUser'])->name('login-user');
Route::get('/signup',[signup::class,'index'])->name('reg');
Route::post('/register-user',[signup::class,'registerUser'])->name('register-user');

