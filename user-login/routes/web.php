<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
    //return view('welcome');
//});

//Route::get('/register',array('as'=>'index','uses'=>'RegisterController@index'));

/*npm i
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::POST('authenticate', [AuthController::class,'authenticate']);
Route::POST('kayıtol', [AuthController::class,'register']);
*/

Auth::routes(['verify'=> true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
