<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClinicianController;

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

Route::apiResource('staff', StaffController::class);
Route::post('staff/{id}/restore', [StaffController::class, 'restore']);

Route::apiResource('clinicians', ClinicianController::class);
Route::post('clinicians/{id}/restore', [ClinicianController::class, 'restore']);
