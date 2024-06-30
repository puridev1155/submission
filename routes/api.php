<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PrizeController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Prizes 명단등록
Route::apiResource('prizes', PrizeController::class);
