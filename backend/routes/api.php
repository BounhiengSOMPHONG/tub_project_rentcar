<?php

use App\Http\Controllers\tblUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblCarsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Get the authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Resource routes for tbl_cars
Route::resource('tbl_cars', TblCarsController::class);
//user / customer route
Route::resource('users', tblUserController::class);


Route::get('/cars/getAll', [TblCarsController::class, 'getAll'])->name('cars.getAll');
Route::post('/cars/add', [TblCarsController::class, 'create'])->name('cars.create');
