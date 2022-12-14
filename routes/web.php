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

Route::get('/register',[AuthController::class,'register'])->name('register')->middleware('isLoggedIn');

Route::get('/',[AuthController::class,'index'])->name('index')->middleware('alreadyLoggedIn');

Route::get('/email',[AuthController::class,'email'])->name('email');

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard')->middleware('isLoggedIn');

Route::get('/chequedata',[AuthController::class,'chequedata'])->name('chequedata')->middleware('isLoggedIn');

Route::get('/updatechequedata',[AuthController::class,'updatechequedata'])->name('updatechequedata')->middleware('isLoggedIn');

Route::get('/editchequedata/{id}',[AuthController::class,'editchequedata'])->name('editchequedata')->middleware('isLoggedIn');

Route::get('/editaccountdata/{id}',[AuthController::class,'editaccountdata'])->name('editaccountdata')->middleware('isLoggedIn');

Route::get('/editchequenodata/{id}',[AuthController::class,'editchequenodata'])->name('editchequenodata')->middleware('isLoggedIn');

Route::get('/editchequebankdata/{id}',[AuthController::class,'editchequebankdata'])->name('editchequebankdata')->middleware('isLoggedIn');


Route::get('/chequedetails',[AuthController::class,'chequedetails'])->name('chequedetails')->middleware('isLoggedIn');

Route::get('/chequedetail/{id}',[AuthController::class,'chequedetail'])->name('chequedetail')->middleware('isLoggedIn');

Route::get('/updatechequedetail/{id}',[AuthController::class,'updatechequedetail'])->name('updatechequedetail')->middleware('isLoggedIn');

Route::post('/updatecheque/{id}',[AuthController::class,'updatecheque'])->name('updatecheque');

Route::post('/updatecheque2/{id}',[AuthController::class,'updatecheque2'])->name('updatecheque2');

Route::post('/updatecheque3/{id}',[AuthController::class,'updatecheque3'])->name('updatecheque3');

Route::post('/updatecheque4/{id}',[AuthController::class,'updatecheque4'])->name('updatecheque4');

Route::post('/updatecheque5/{id}',[AuthController::class,'updatecheque5'])->name('updatecheque5');

Route::post('/recaptcha',[AuthController::class,'recaptcha'])->name('recaptcha');

Route::post('/store',[AuthController::class,'store'])->name('store');

Route::post('/chequedatastore',[AuthController::class,'chequedatastore'])->name('chequedatastore');

Route::post('/registeruser',[AuthController::class,'registeruser'])->name('registeruser');

Route::post('loginuser',[AuthController::class,'loginuser'])->name('loginuser');

Route::post('email',[AuthController::class,'emailuser'])->name('emailuser');

Route::post('logout',[AuthController::class,'logout'])->name('logout');

// Route::post('api/fetch-transaction', [AuthController::class, 'fetchtransaction']);

Route::get('chequedetails', [AuthController::class, 'details'])->name('cheque.details');

Route::get('updatechequedata', [AuthController::class, 'data'])->name('updatecheque.data');

Route::get('updatechequedata2', [AuthController::class, 'data2'])->name('updatecheque2.data');

Route::get('updatechequedata3', [AuthController::class, 'data3'])->name('updatecheque3.data');

Route::get('updatechequedata4', [AuthController::class, 'data4'])->name('updatecheque4.data');



Route::delete('/updatechequedata/{id}', [AuthController::class, 'updatechequedata'])->name('updatechequedata');
Route::delete('/updateaccountdata/{id}', [AuthController::class, 'updateaccountdata'])->name('updateaccountdata');
Route::delete('/updatebankdata/{id}', [AuthController::class, 'updatebankdata'])->name('updatebankdata');



