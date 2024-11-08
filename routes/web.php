<?php

use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PythonApi\PythonApiController;
use App\Http\Controllers\SkillController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Career history
    Route::prefix('/career-histories')->name('career.histories.')->controller(CareerHistoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/{careerHistory}', 'update')->name('update');
        Route::delete('/delete/{careerHistory}', 'delete')->name('delete');
    });

    //Skill
    Route::prefix('/skills')->name('skills.')->controller(SkillController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
    });

    //Python api
    Route::post('/chat-response', [PythonApiController::class, 'getResponse'])->name('generate.path');
});

require __DIR__ . '/auth.php';
