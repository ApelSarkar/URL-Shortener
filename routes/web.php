<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

// Redirect users to home after login

// Authenticated routes for URL shortening
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/shorten', [UrlShortenerController::class, 'shorten'])->name('shorten');
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
    Route::get('/user/urls', [UrlShortenerController::class, 'userUrls'])->name('user.urls');

});

// Route to handle short URL redirection
Route::get('/{code}', [UrlShortenerController::class, 'redirect'])->name('redirect');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
