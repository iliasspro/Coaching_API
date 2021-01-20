<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//------Authentication-------//
Route::post('login', [LoginController::class, 'login']);

//------registration-------//
Route::post('register', [LoginController::class, 'register']);

//------Get all Coachs Data-------//
Route::get('coachs', [UserController::class, 'getCoachs']);

//------Add Coach-------//
Route::post('coach', [UserController::class, 'addCoach']);

//------Add Review to User-------//
Route::post('addUserReview', [UserController::class, 'addUserReview']);

//------Get Package review by Package ID-------//
Route::get('getPackageReview/{id}', [UserController::class, 'getPackageReview']);

//------Get User Packages by User ID-------//
Route::get('getUserPackage/{idu}', [PackageController::class, 'getUserPackage']);

//------Add new Package to User by User ID-------//
Route::post('addUserPackage', [PackageController::class, 'addUserPackage']);

//------Get User review by User ID-------//
Route::post('getUserReview/{id}', [UserController::class, 'getUserReview']);
