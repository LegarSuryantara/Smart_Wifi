<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CustomerController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view users', only: ['index']),
        ];
    }

    /**
     * Export customers to PDF
     */
    public function exportPdf()
    {
        try {
            $customers = User::whereHas('roles', function($q) {
                $q->where('name', 'user');
            })->get();

            $pdf = Pdf::loadView('admin.customers.pdf', [
                'customers' => $customers
            ]);

            return $pdf->stream('customer-list-'.date('Ymd-His').'.pdf');
            
        } catch (\Exception $e) {
            return redirect()->route('customers.index')
                ->with('error', 'Failed to generate PDF: '.$e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[\p{L}\p{N}\s\-@.]+$/u',
            'sort' => 'nullable|in:newest,oldest,name_asc,name_desc'
        ]);

        $query = User::whereHas('roles', function($q) {
            $q->where('name', 'user');
        });

        // Search functionality
        if (!empty($validated['search'])) {
            $search = addslashes($validated['search']);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        switch ($validated['sort'] ?? 'newest') {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name');
                break;
            case 'name_desc':
                $query->orderByDesc('name');
                break;
            default:
                $query->latest();
        }

        $customers = $query->paginate(10);

        return view('admin.customers.list', [
            'customers' => $customers,
            'filters' => $validated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementation if needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementation if needed
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementation if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementation if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implementation if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implementation if needed
    }
}