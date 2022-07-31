<?php

use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//protected routes
Route::group(['middleware' => ['jwt.verify']], function () {
});

Route::middleware('auth:sanctum')->get('/username', function (Request $request) {
    return $request->user();
});

// Teachers ROUTE
Route::group(['prefix' => 'teacher'], function () {
    Route::get('/', [TeacherController::class, 'getAll']);
    Route::get('/{id}', [TeacherController::class, 'getById']);
    Route::post('/', [TeacherController::class, 'create']);
    Route::put('/{id}', [TeacherController::class, 'update']);
    Route::delete('/{id}', [TeacherController::class, 'delete']);
    Route::post('register', [TeacherController::class, 'register']);
    Route::post('login', [TeacherController::class, 'authenticate']);
});

//Students ROUTE
Route::group(['prefix' => 'student'], function () {
    Route::get('/', [StudentController::class, 'getAll']);
    Route::get('/{id}', [StudentController::class, 'getById']);
    Route::post('/', [StudentController::class, 'create']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'delete']);
    Route::post('register', [StudentController::class, 'register']);
    Route::post('login', [StudentController::class, 'authenticate']);
});

//Homework ROUTE
Route::group(['prefix' => 'homework'], function () {
    Route::get('/', [HomeworkController::class, 'getAll']);
    Route::get('/{id}', [HomeworkController::class, 'getById']);
    Route::post('/', [HomeworkController::class, 'create']);
    Route::put('/{id}', [HomeworkController::class, 'update']);
    Route::delete('/{id}', [HomeworkController::class, 'delete']);
});
