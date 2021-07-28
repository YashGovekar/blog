<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('auth')->as('auth.')->group(function () {
    // Registration Routes
    Route::get('/register', [Auth\RegistrationController::class, 'index'])->name('register.index');
    Route::post('/register', [Auth\RegistrationController::class, 'register'])->name('register.post');

    // Login Routes
    Route::get('/login', [Auth\LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [Auth\LoginController::class, 'login'])->name('login.post');

    // Logout Route
    Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');
});


Route::middleware('auth')->prefix('posts')->as('posts.')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('edit');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::patch('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'update'])->name('destroy');
});

Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

Route::middleware('auth')->prefix('profile')->as('profile.')->group(function () {
    Route::get('/posts', [ProfileController::class, 'posts'])->name('posts');

    // Other Routes for Author's Profile
});
