<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EmployeeController;
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

// Authentication
Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
    });

// Users
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Skills
/*Route::apiResource('skill', SkillController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy'])
    ->middleware('auth:sanctum');*/
Route::controller(SkillController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/skill', 'index');
        Route::post('/skill', 'store');
        Route::get('/skill/{id}', 'show');
        Route::put('/skill/{id}', 'update');
        Route::delete('/skill/{id}', 'destroy');
    });

// Employees
Route::controller(EmployeeController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/employee', 'index');
        Route::post('/employee', 'store');
        Route::get('/employee/{id}', 'show');
        Route::put('/employee/{id}', 'update');
        Route::delete('/employee/{id}', 'destroy');
    });

