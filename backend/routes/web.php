<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\AdminCtrl as AdminCtrl;
use App\Http\Controllers\admin\DashboardCtrl as DashboardCtrl;
use App\Http\Controllers\Manager\ManagerCtrl as ManagerCtrl;
use App\Http\Controllers\Auth\RegisteredUserController;

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
    return view('login');
    
});
//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/index', [AdminCtrl::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [DashboardCtrl::class, 'index'])->name('admin.dashboard');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Manager
Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'role:manager']], function () {
    Route::get('/index', [ManagerCtrl::class, 'index'])->name('manager.index');
    Route::get('/logout', [ManagerCtrl::class, 'logout'])->name('manager.logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
