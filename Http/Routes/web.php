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
Route::prefix('admin')->group(function() {
    Route::get('/home', 'AdminController@home')->name('maestro.admin.home');
    Route::get('/login', 'AdminController@login')->name('maestro.admin.login');
    Route::get('/logout', 'AdminController@logout')->name('maestro.admin.logout');
});
