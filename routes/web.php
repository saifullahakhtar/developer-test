<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers as Web;

Route::group(['middleware' => ['auth']], function () { 

    // Home Routes
    Route::get('/', [Web\HomeController::class, 'index']);
    Route::get('/home', [Web\HomeController::class, 'index'])->name('home');
    
    // Lesson Routes
    Route::get('/course/{course}', [Web\LessonController::class, 'index']);
    Route::get('/lessons/{lesson}', [Web\LessonController::class, 'view']);
    Route::post('/watch', [Web\LessonController::class, 'watch'])->name('watch');

    // User Lessons Route
    Route::get('/users/{user}/my-lessons', [Web\LessonController::class, 'myLessons']);

    // Comment Routes
    Route::get('/discussion-fourm', [Web\CommentController::class, 'index']);
    Route::post('/comment', [Web\CommentController::class, 'comment'])->name('comment');

    // Achievements Route
    Route::get('/users/{user}/achievements', [Web\AchievementsController::class, 'index']);

});

Auth::routes();