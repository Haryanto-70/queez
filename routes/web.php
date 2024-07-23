<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\DeskController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/display', function () {
//     return Inertia::render('Display/Dashboard');
// })->middleware(['auth', 'verified'])->name('display');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ProfileController::class, 'users'])->name('profile.users');

    Route::get('/display', [DisplayController::class, 'display'])->name('display');

    Route::get('/desk/{dNo}', [DeskController::class, 'desk'])->name('desk');
    Route::get('/userdesk', [DeskController::class, 'userdesk'])->name('userdesk');
    Route::get('/userdesk/queue/{type}', [DeskController::class, 'queuelist'])->name('queuelist');

    Route::get('/dispenser', [DisplayController::class, 'dispenser'])->name('dispenser');
    Route::put('/queue/{sId}', [DisplayController::class, 'queue'])->name('queue');
});

require __DIR__ . '/auth.php';
