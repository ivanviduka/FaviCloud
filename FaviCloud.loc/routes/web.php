<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('dashboard.index');
//});

//File Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name("files");
    Route::post('file', [FileController::class, 'addFile'])->name("file.upload");
    Route::get('file', [FileController::class, 'createForm'])->name("file.form");
    Route::delete('file/{file}', [FileController::class, 'deleteFile'])->name("file.delete");

});

//Route::get('/',  [FileController::class, 'index'])->name("files");
//Route::post('file', [FileController::class, 'addFile'])->name("file.upload");
//Route::get('file', [FileController::class, 'createForm']);
//Route::delete('file/{file}', [FileController::class, 'deleteFile'])->name("file.delete");

// Login Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//Registration Routes
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');



