<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanteApiDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\PlanteUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::prefix('/plante')->group(function () {
    Route::get('/', [PlanteController::class, 'index']);
    Route::post('/', [PlanteController::class, 'store']);
    Route::get('/{id}', [PlanteController::class, 'show']);
    Route::put('/{id}', [PlanteController::class, 'update']);
    Route::delete('/{id}', [PlanteController::class, 'destroy']);
    Route::post('/attach', [PlanteUserController::class, 'attachUserToPlante']);
    Route::post('/detach', [PlanteUserController::class, 'detachUserFromPlante']);
    Route::post('/userid', [PlanteUserController::class, 'getPlantesByUser']);
});
Route::get('/addPlanteApi', [PlanteApiDataController::class, 'addAllPlante']);
