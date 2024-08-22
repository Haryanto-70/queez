<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\Auth\RegisteredUserController;
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


Route::get('/setting', function () {
    return Inertia::render('Admin/Management');
})->middleware(['auth', 'verified'])->name('setting');

Route::get('/performance', function () {
    return Inertia::render('Performance/Performance');
})->middleware(['auth', 'verified'])->name('performance');

Route::get('/error', function () {
    return Inertia::render('Error/404');
})->name('error404');

// Route::get('/display', function () {
//     return Inertia::render('Display/Dashboard');
// })->middleware(['auth', 'verified'])->name('display');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ProfileController::class, 'users'])->name('profile.users');

    Route::get('/userlist', [ProfileController::class, 'userlist'])->name('userlist');
    Route::post('/adduser/{id}', [RegisteredUserController::class, 'adduser']);
    Route::post('/edituser/{id}', [RegisteredUserController::class, 'edituser']);
    Route::get('/roleslist', [RegisteredUserController::class, 'roleslist']);


    Route::get('/display', [DisplayController::class, 'display'])->name('display');
    Route::get('/dsiplay/queue', [DisplayController::class, 'displayqueue'])->name('display.queue');

    Route::get('/desk/{dNo}', [DeskController::class, 'desk'])->name('desk');
    Route::get('/userdesk', [DeskController::class, 'userdesk'])->name('userdesk');
    Route::get('/userdesk/queue/{type}', [DeskController::class, 'queuelist'])->name('queuelist');
    Route::put('/userdesk/select/{quuid}', [DeskController::class, 'selectqueue'])->name('selectqueue');
    Route::put('/userdesk/calling/{qNo}', [DeskController::class, 'callqueue'])->name('callqueue');
    Route::put('/userdesk/finished/{qNo}', [DeskController::class, 'finishedqueue'])->name('finishedqueue');
    Route::get('/userdesk/exitdesk', [DeskController::class, 'exitdesk'])->name('exitdesk');
    Route::put('/userdesk/quecancel/{qNo}', [DeskController::class, 'quecancel'])->name('quecancel');
    Route::put('/userdesk/questart/{qNo}', [DeskController::class, 'startqueue'])->name('startqueue');



    Route::get('/dispenser', [DisplayController::class, 'dispenser'])->name('dispenser');
    Route::get('/dispencers', [DisplayController::class, 'dispencers'])->name('dispencers');

    Route::put('/queue/{sId}', [DisplayController::class, 'queue'])->name('queue');

    Route::put('/queue/next/{qId}', [DisplayController::class, 'callnext'])->name('callnext');
});

require __DIR__ . '/auth.php';
