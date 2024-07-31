<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function(){

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    
})->middleware('api');


Route::post('register',[RegisterController::class,'register']);


Route::prefix('grade')->group(function(){

    Route::get('grades',[GradeController::class,'index']);
    Route::post('store',[GradeController::class,'store']);
    Route::post('update/{id}',[GradeController::class,'update']);
    Route::post('destroy/{id}',[GradeController::class,'destroy']);

    Route::get('subjects',[SubjectController::class,'index']);
    Route::get('students',[GradeController::class,'students']);

})->middleware('auth:api');