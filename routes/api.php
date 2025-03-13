<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\parkingController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/testing', function(){
    return response()->json([
        'name' => 'yasser'
    ]);
});

Route::get('/parkings',[parkingController::class,'index']);
Route::post('/parkings',[parkingController::class,'add']);
Route::put('/parkings/{id}',[parkingController::class,'update']);
Route::delete('/parkings/{id}',[parkingController::class,'delete']);


//////////////////////////////


Route::post('/user/register',[AuthController::class , 'register']);
Route::post('/user/login' , [AuthController::class , 'login']);