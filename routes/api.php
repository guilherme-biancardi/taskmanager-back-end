<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::prefix('tasks')->group(function () {
    Route::get('/', [TasksController::class, 'index']);
    Route::post('/', [TasksController::class, 'store']);
    Route::patch('/edit/{id}', [TasksController::class, 'update']);
    Route::post('/complete', [TasksController::class, 'completeTask']);
    Route::post('/cancel', [TasksController::class, 'cancelTask']);
});

Route::prefix('tasks/delete')->group(function () {
    Route::delete('/', [TasksController::class, 'removeAllTasks']);
    Route::delete('/{id}', [TasksController::class, 'remove']);
    Route::delete('/date/{date}', [TasksController::class, 'removeByDate']);
    Route::delete('/date/{start}/{end}', [TasksController::class, 'removeByPeriod']);
    Route::delete('/year/{year}', [TasksController::class, 'removeByYear']);
    Route::delete('/status/{status}', [TasksController::class, 'removeByStatus']);
});
