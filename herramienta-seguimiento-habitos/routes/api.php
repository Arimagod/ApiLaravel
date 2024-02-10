<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Habit_typeController;
use App\Http\Controllers\Api\HabitController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\FrequencyController;
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
Route::post('/habit_types/update',[Habit_typeController::class, 'update']);
Route::post('/habit_types/create',[Habit_typeController::class, 'create']);


Route::get('/habits',[HabitController::class, 'list']);
Route::get('/habits/{id}', [Habit_typeController::class, 'item']);
Route::post('/habits/create',[HabitController::class, 'create']);
Route::post('/habits/update',[HabitController::class, 'update']);


Route::get('/statuses',[StatusController::class, 'list']);
Route::get('/statuses/{id}', [StatusController::class, 'item']);
Route::post('/statuses/create',[StatusController::class, 'create']);
Route::post('/statuses/update',[StatusController::class, 'update']);

Route::get('/frequencies',[FrequencyController::class, 'list']);
Route::get('/frequencies/{id}', [FrequencyController::class, 'item']);
Route::post('/frequencies/create',[FrequencyController::class, 'create']);
Route::post('/frequencies/update',[FrequencyController::class, 'update']);

Route::get('/users',[UsersController::class, 'list']);
Route::get('/users/{id}', [UsersController::class, 'item']);
Route::post('/users/create',[UsersController::class, 'create']);
Route::post('/users/update',[UsersController::class, 'update']);







