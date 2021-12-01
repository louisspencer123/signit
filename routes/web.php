<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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


/* Registration Routes*/
Route::get('/register', [UserController::class, 'create'])->name('register');;
Route::post('/register', [UserController::class, 'store'])->name('store');

/* Index Route when the website is loaded*/
Route::get('/', [WelcomeController::class, 'index']);

/* Login Routes*/
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

/* Resource Routes for Visitor CRUD operations*/
Route::resource('/visitors', VisitorController::class);

/* Logout Route*/
Route::get('/logout', [LoginController::class, 'logout']);





