<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserDashboardController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware()
    {
         return[
            new Middleware('permission:user-access', only: ['index']),
         ];
    }
    public function index()
    {
        $pakets = Pakets::all();
        return view('user.dashboard', compact('pakets'));
    }
}
