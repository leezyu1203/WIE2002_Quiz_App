<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/main/add', [MainController::class, 'add_note'])->name('main.add');
Route::put('/main/edit/{id}', [MainController::class, 'edit'])->name('main.edit');
Route::delete('/main/delete/{id}', [MainController::class, 'delete'])->name('main.delete');
Route::get('/main/search', [MainController::class, 'search'])->name('main.search');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/register', [AuthController::class, 'register_acc'])->name('auth.register');
Route::post('/auth/check', [AuthController::class, 'check_acc'])->name('auth.check');
