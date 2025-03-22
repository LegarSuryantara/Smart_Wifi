<?php

use App\Http\Controllers\adminPaketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('listpaket');
});
Route::get('login', function () {
    return view('login');
});

Route::prefix('admin')->group(function () {
    Route::resource('pakets', adminPaketsController::class);
});
