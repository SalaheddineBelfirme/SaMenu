<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrganisationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::get('/v1/category',[CategoryController::class,'index']);
Route::post('/v1/category',[CategoryController::class,'store']);
Route::delete('/v1/category/{id}',[CategoryController::class,'delete']);




Route::post('v1/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('v1/contacts', [ContactController::class, 'index']);
});



Route::middleware(['auth:sanctum', 'role:admin_project'])->group(function () {
    Route::get('/v1/menu',[MenuController::class,'index']);
    Route::post('/v1/menu',[MenuController::class,'store']);
    Route::put('/v1/menu',[MenuController::class,'update']);
    Route::delete('/v1/menu/{id}', [MenuController::class, 'delete']);
});










Route::get('v1/contacts/search/{target}', [ContactController::class, 'search']);
Route::get('v1/contacts/{id}', [ContactController::class, 'show']);
Route::post('v1/contacts', [ContactController::class, 'store']);
Route::put('v1/contacts', [ContactController::class, 'update']);
Route::delete('v1/contacts', [ContactController::class, 'destroy']);

Route::post('v1/contacts/duplicate', [ContactController::class, 'isDuplicate']);
Route::post('v1/organisations/duplicate', [OrganisationController::class, 'isDuplicate']);




Route::fallback(function () {
    return response()->json([
        'message' => 'Route Not Found'
    ], 404);
});
