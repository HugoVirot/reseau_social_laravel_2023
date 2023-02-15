<?php

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

// ************************** page de connexion / inscription ******************************

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


// *********************** ACCUEIL (home.blade.php)/ liste des quacks**************************

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');


// ********************************** routes AUTHENTIFICATION (Laravel Ui) *******************************

Auth::routes();


// ********************************** route resource USERS *******************************

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');
