<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\CourseController;
use \App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserDocumentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('courses', CourseController::class)->only([
    'index', 'show'
]);

Route::resource('courses.lessons', LessonController::class)->only([
    'show'
]);

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->only([
        'show', 'update'
    ]);
    
    Route::resource('users-courses', UserCourseController::class)->only([
        'store', 'update'
    ]);

    Route::resource('users-documents', UserDocumentController::class)->only([
        'store'
    ]);

    Route::resource('reviews', ReviewController::class)->only([
        'store', 'update'
    ]);
});

Auth::routes();
// Route::get('denmo', )
