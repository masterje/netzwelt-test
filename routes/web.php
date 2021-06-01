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

Route::any('', '\App\Http\Controllers\Controller@index')->middleware(['auth'])->name('home');

Route::any('home/index', '\App\Http\Controllers\Controller@index')->middleware(['auth'])->name('homeindex');

require __DIR__.'/auth.php';
