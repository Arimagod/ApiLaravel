<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Habit_typeController;
use App\Http\Controllers\Api\HabitController;
use App\Http\Controllers\Api\progress_statisticsController;
use App\Http\Controllers\Api\Tracking_logController;
use App\Http\Controllers\Api\UsersController;



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


Route::get('/habit_types',[Habit_typeController::class, 'list']);
Route::get('/habit_types/{id}', [Habit_typeController::class, 'item']);

Route::get('/habits',[HabitController::class, 'list']);
Route::get('/habits/{id}', [Habit_typeController::class, 'item']);


Route::get('/progress_statistics',[progress_statisticsController::class, 'list']);
Route::get('/progress_statistics/{id}', [progress_statisticsController::class, 'item']);

Route::get('/tracking_logs',[tracking_logController::class, 'list']);
Route::get('/tracking_logs/{id}', [tracking_logController::class, 'item']);

Route::get('/users',[UsersController::class, 'list']);
Route::get('/users/{id}', [UsersController::class, 'item']);
Route::post('/users/create',[UsersController::class, 'create']);
Route::post('/users/update',[UsersController::class, 'update']);


Route::post('/tracking_logs/create',[tracking_logController::class, 'create']);
Route::post('/progress_statistics/create',[progress_statisticsController::class, 'create']);
Route::post('/habits/create',[HabitController::class, 'create']);
Route::post('/habit_types/create',[Habit_typeController::class, 'create']);

Route::post('/habit_types/update',[Habit_typeController::class, 'update']);
Route::post('/habits/update',[HabitController::class, 'update']);
Route::post('/progress_statistics/update',[progress_statisticsController::class, 'update']);
Route::post('/tracking_logs/update',[tracking_logController::class, 'update']);




