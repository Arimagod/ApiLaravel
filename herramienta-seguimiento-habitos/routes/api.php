<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Habit_typesController;
use App\Http\Controllers\Api\HabitsController;
use App\Http\Controllers\Api\StatusesController;
use App\Http\Controllers\Api\FrequenciesController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AuthController;



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


Route::get('/habit_typs',[Habit_typesController::class, 'list']);
Route::get('/habit_types/{id}', [Habit_typesController::class, 'item']);
Route::post('/habit_types/update',[Habit_typesController::class, 'update']);
Route::post('/habit_types/create',[Habit_typesController::class, 'create']);


Route::get('/habits',[HabitsController::class, 'list']);
Route::get('/habits/{id}', [HabitsController::class, 'item']);
Route::post('/habits/create',[HabitsController::class, 'create']);
Route::post('/habits/update',[HabitsController::class, 'update']);


Route::get('/statuses',[StatusesController::class, 'list']);
Route::get('/statuses/{id}', [StatusesController::class, 'item']);
Route::post('/statuses/create',[StatusesController::class, 'create']);
Route::post('/statuses/update',[StatusesController::class, 'update']);

Route::get('/frequencies',[FrequenciesController::class, 'list']);
Route::get('/frequencies/{id}', [FrequenciesController::class, 'item']);
Route::post('/frequencies/create',[FrequenciesController::class, 'create']);
Route::post('/frequencies/update',[FrequenciesController::class, 'update']);

Route::get('/users',[UsersController::class, 'list']);
Route::get('/users/{id}', [UsersController::class, 'item']);
Route::post('/users/create',[UsersController::class, 'create']);
Route::post('/users/update',[UsersController::class, 'update']);


Route::post('/auth/login', [AuthController::class, 'login']);


Route::get('/Elements/{id}',[HabitController::class, 'elements']);
Route::get('/Elements2',[HabitController::class, 'elements']);

Route::get('/search/{letter}', [Habit_typesController::class, 'search']);






