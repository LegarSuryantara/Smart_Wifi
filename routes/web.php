<?php

use App\Http\Controllers\adminPaketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('listpaket');
});

Route::prefix('admin')->group(function () {
    Route::resource('pakets', adminPaketsController::class);
});
