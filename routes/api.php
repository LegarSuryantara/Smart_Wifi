<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;


Route::post('/midtrans-callback', [OrdersController::class, 'callback']);