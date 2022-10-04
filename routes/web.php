<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('recaptcha');
});

Route::get('/login',[AuthController::class,'login'])->name('login')->middleware('alreadyLoggedIn');

// Route::get('/register',[AuthController::class,'register'])->name('register');

Route::get('/',[AuthController::class,'index'])->name('index')->middleware('alreadyLoggedIn');

Route::get('/email',[AuthController::class,'email'])->name('email');

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard')->middleware('isLoggedIn');

Route::get('/chequedetails',[AuthController::class,'chequedetails'])->name('chequedetails')->middleware('isLoggedIn');

Route::get('/chequedetail/{id}',[AuthController::class,'chequedetail'])->name('chequedetail')->middleware('isLoggedIn');

Route::get('/updatechequedetail/{id}',[AuthController::class,'updatechequedetail'])->name('updatechequedetail')->middleware('isLoggedIn');

Route::post('/updatecheque/{id}',[AuthController::class,'updatecheque'])->name('updatecheque');

Route::post('/recaptcha',[AuthController::class,'recaptcha'])->name('recaptcha');

Route::post('/store',[AuthController::class,'store'])->name('store');

// Route::post('/registeruser',[AuthController::class,'registeruser'])->name('registeruser');

Route::post('loginuser',[AuthController::class,'loginuser'])->name('loginuser');

Route::post('email',[AuthController::class,'emailuser'])->name('emailuser');

Route::post('logout',[AuthController::class,'logout'])->name('logout');