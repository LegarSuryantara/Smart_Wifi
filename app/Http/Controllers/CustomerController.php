<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Pest\ArchPresets\Custom;
use App\Models\Customer;

class CustomerController extends Controller
{

    public function exportPdf()
    {
        // Fetch all customers from the database
        $customers = User::whereHas('roles', function($q) {
            $q->where('name', 'user');
        })->get();

        // Load the view and pass the customers data
        $pdf = Pdf::loadView('admin.customers.pdf', compact('customers'));

        // Download the PDF file
        return $pdf->stream('customer-list.pdf');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::whereHas('roles', function($q) {
            $q->where('name', 'user');
        })->paginate(10);

        return view('admin.customers.list', compact('customers'));
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
