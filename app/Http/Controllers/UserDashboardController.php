<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Ambil semua paket untuk ditampilkan di halaman user
        $pakets = Pakets::all();

        // Ambil paket aktif user
        $activeOrders = Orders::with('paket')
            ->where('user_id', Auth::id())
            ->where('is_activated', 'yes')
            ->get();

        return view('user.dashboard', compact('pakets', 'activeOrders'));
    }
}
