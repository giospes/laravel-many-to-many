<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// // Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::prefix('projects')->name('projects.')->group(function (){
        Route::get('/', [ProjectsController::class, 'index'])->name('index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('create');
        Route::get('/{slug}', [ProjectsController::class, 'show'])->name('show');
        Route::get('/{slug}/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::post('/', [ProjectsController::class, 'store'])->name('store');
        Route::put('/{project}', [ProjectsController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectsController::class, 'destroy'])->name('destroy');
    });
    
});
require __DIR__.'/auth.php';
