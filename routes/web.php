<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return 'Home page';
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])
                ->name('admin.') // aggiunge un prefisso al nome della rotta -> dashboard -> admin.dashboard
                ->prefix('admin') // aggiunge un prefisso all'uri della rotta -> / -> /admin + / = /admin/
                 ->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //route('dashboard) -> route('admin.dashboard')
    // -> /admin/dashboard

    Route::resource('posts', PostController::class)->parameters(['posts'=>'post:slug']);

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//rotte di autenticazione
require __DIR__.'/auth.php';
