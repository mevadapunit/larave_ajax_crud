<?php

use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->name('users');
Route::get('/fetch', [DashboardController::class, 'fetch'])->name('getall.users');
Route::get('/show', [DashboardController::class, 'show'])->name('detail.users');
Route::post('/store', [DashboardController::class, 'store'])->name('save.users');
Route::delete('/delete', [DashboardController::class, 'destroy'])->name('delete.users');
Route::get('/edit', [DashboardController::class, 'edit'])->name('edit.users');
Route::post('/update', [DashboardController::class, 'update'])->name('update.users');

Route::get('/education', [EducationController::class, 'index'])->name('education');
Route::get('/education/fetch', [EducationController::class, 'fetch'])->name('fetch.education');
Route::post('/education/store', [EducationController::class, 'store'])->name('save.education');
Route::delete('/education/delete', [EducationController::class, 'destroy'])->name('delete.education');
Route::get('/education/edit', [EducationController::class, 'edit'])->name('edit.education');
Route::post('/education/update', [EducationController::class, 'update'])->name('update.education');

