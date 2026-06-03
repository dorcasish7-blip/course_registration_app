<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class)->except(['show']);
    Route::resource('courses', CourseController::class)->except(['show']);

    Route::get('enrollment', [RegistrationController::class, 'create'])->name('enrollment.create');
    Route::post('enrollment', [RegistrationController::class, 'store'])->name('enrollment.store');

    Route::get('reports', [RegistrationController::class, 'index'])->name('reports.index');
    Route::get('reports/{student}', [RegistrationController::class, 'studentReport'])->name('reports.student');
});
