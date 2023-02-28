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


// *********************** ACCUEIL (home.blade.php)/ liste des messages **************************

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');


// ********************************** routes AUTHENTIFICATION (Laravel Ui) *******************************

Auth::routes();


// ********************************** route resource USERS *******************************

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');


// ********************************** route resource POSTS *******************************

Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index', 'create', 'show');


// ********************************** rechercher un post *******************************

Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');


// ********************************** route resource COMMENTS *******************************

Route::resource('/comments', App\Http\Controllers\CommentController::class)->except('index', 'create', 'show');


// *********************** route back-office (admin uniquement) *****************************

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('admin');

