<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard/dashboard/dashboard');
})->name(name: 'dashboard-dashboard');

// Authentication
Route::get(uri: '/sign-in', action: function () {
    return view(view: 'authentication/sign-in');
})->name(name: 'auth-sign-in');

Route::get(uri: '/register', action: function () {
    return view(view: 'authentication/register');
})->name(name: 'auth-register');

Route::get(uri: '/forgot-password', action: function () {
    return view(view: 'authentication/forgot-password');
})->name(name: 'auth-forgot-password');