<?php

use App\Models\pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedcineController;
use App\Http\Controllers\PharmacistController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('pharmasists',[PharmacistController::class,'index']);
Route::post('register',[PharmacistController::class,'register']);
Route::post('login',[PharmacistController::class,'login']);
Route::post('webLogin',[PharmacistController::class,'webLogin']);
// Route::post('logout',[PharmacistController::class,'logout']);
// Route::get('medcines',[MedcineController::class,'index']);
// Route::post('medcines',[MedcineController::class,'store']);
// Route::get('medcines/{medcine}',[MedcineController::class,'show']);
// Route::delete('medcines/{medcine}',[MedcineController::class,'destroy']);
// Route::patch('medcines/{medcine}',[MedcineController::class,'update']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('medcines', MedcineController::class);
});