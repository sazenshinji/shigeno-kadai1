<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/modifies', [ContactController::class, 'modifies']);
Route::get('/contacts/thanks', [ContactController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'login']);
    Route::post('/delete', [AuthController::class, 'destroy']);
});

Route::get('/contacts/search', [AuthController::class, 'search']);

Route::post('/custom-login', [LoginController::class, 'login'])->name('custom.login');
