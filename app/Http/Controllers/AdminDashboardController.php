<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class AdminDashboardController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

     public static function middleware()
     {
         return [
             new Middleware('permission:admin-access'),
         ];
     }

    public function index()
    {
        $pakets = Pakets::all();

        $orders = Orders::where('transaction_status', 'settlement')
            ->where('is_activated', 'no')
            ->latest()
            ->get();

        // Kirim ke view
        return view('admin.dashboard', compact('pakets', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
