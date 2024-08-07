<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/csrf-token', function (Request $request) {
    return response($request)->withCookie(cookie('XSRF-TOKEN', $request->session()->token()));
});

Route::group(['prefix'=>'auth'], function(){
    Route::post('register', [AuthController::class, 'postRegister']);
    Route::post('login', [AuthController::class, 'postLogin']);
    Route::middleware('auth.jwt')->post('logout', [AuthController::class, 'postLogout']);
});

Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('category/{slug}/books', [CategoryController::class, 'getCategoryBySlug']);
Route::get('book/{slug}', [BookController::class, 'getBookBySlug']);

Route::group(['middleware'=>['api', 'auth.jwt']], function(){
    Route::get('user', [UserController::class, 'getIndex']);
    Route::post('email/verify', [AuthController::class, 'postVerifyEmail']);
    Route::post('checkout', [CheckoutController::class, 'postIndex']);
});


/* controller for testing */
Route::group(['prefix'=>'test'], function(){
    Route::any('send-email', [TestController::class, 'sendVerification']);
});
