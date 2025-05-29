<?php

use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\CardioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return redirect('/workouts');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/user/password', [PasswordController::class, 'update'])->name('user-password.update');

    // ジム記録関連ルート 👇
    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{id}/edit', [WorkoutController::class, 'edit'])->name('workouts.edit');
    Route::put('/workouts/{id}', [WorkoutController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
    Route::get('/workouts/history', [WorkoutController::class, 'history'])->name('workouts.history');
    Route::get('/workouts/history/{date}', [WorkoutController::class, 'showByDate'])->name('workouts.history.date');

    // 有酸素メニュー
    Route::post('/cardios', [CardioController::class, 'store'])->name('cardios.store');
    Route::get('/cardios/{id}/edit', [CardioController::class, 'edit'])->name('cardios.edit');
    Route::put('/cardios/{id}', [CardioController::class, 'update'])->name('cardios.update');
    Route::delete('/cardios/{id}', [CardioController::class, 'destroy'])->name('cardios.destroy');
});

require __DIR__.'/auth.php';
