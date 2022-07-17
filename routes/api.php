<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\TrainerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SchedulerController;
use App\Http\Controllers\Api\GymLessonsController;
use App\Http\Controllers\Api\TrainerLessonsController;
use App\Http\Controllers\Api\CategoryLessonsController;
use App\Http\Controllers\Api\LessonSchedulersController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        Route::apiResource('gyms', GymController::class);

        // Gym Lessons
        Route::get('/gyms/{gym}/lessons', [
            GymLessonsController::class,
            'index',
        ])->name('gyms.lessons.index');
        Route::post('/gyms/{gym}/lessons', [
            GymLessonsController::class,
            'store',
        ])->name('gyms.lessons.store');

        Route::apiResource('categories', CategoryController::class);

        // Category Lessons
        Route::get('/categories/{category}/lessons', [
            CategoryLessonsController::class,
            'index',
        ])->name('categories.lessons.index');
        Route::post('/categories/{category}/lessons', [
            CategoryLessonsController::class,
            'store',
        ])->name('categories.lessons.store');

        Route::apiResource('trainers', TrainerController::class);

        // Trainer Lessons
        Route::get('/trainers/{trainer}/lessons', [
            TrainerLessonsController::class,
            'index',
        ])->name('trainers.lessons.index');
        Route::post('/trainers/{trainer}/lessons', [
            TrainerLessonsController::class,
            'store',
        ])->name('trainers.lessons.store');

        Route::apiResource('lessons', LessonController::class);
        Route::get('available-lessons', [LessonController::class, 'availableLessons']);

        // Lesson Schedulers
        Route::get('/lessons/{lesson}/schedulers', [
            LessonSchedulersController::class,
            'index',
        ])->name('lessons.schedulers.index');
        Route::post('/lessons/{lesson}/schedulers', [
            LessonSchedulersController::class,
            'store',
        ])->name('lessons.schedulers.store');
    });
