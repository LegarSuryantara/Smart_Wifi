<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PaketController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view pakets', only: ['index']),
            new Middleware('permission:edit pakets', only: ['edit']),
            new Middleware('permission:create pakets', only: ['create']),
            new Middleware('permission:delete pakets', only: ['destroy']),
        ];
    }

    /**
     * Menampilkan daftar paket.
     */
    public function index(Request $request)
    {
        /// Ambil parameter pencarian
        $search = $request->input('search');
        
        $sort = $request->input('sort', 'newest');

    // Query dengan Eloquent
        $pakets = Pakets::query()
            ->when($search, function ($query) use ($search) {
                // Validasi sederhana agar search hanya huruf, angka, spasi, dan strip
                if (preg_match('/^[a-zA-Z0-9\s\-]+$/', $search)) {
                    return $query->where('nama_paket', 'like', "%{$search}%");
                }
                // Jika tidak valid, abaikan filter search
                return $query;
            })
            ->when($sort === 'oldest', fn ($query) => $query->oldest())
            ->when($sort === 'name_asc', fn ($query) => $query->orderBy('nama_paket', 'asc'))
            ->when($sort === 'name_desc', fn ($query) => $query->orderBy('nama_paket', 'desc'))
            ->when($sort === 'newest', fn ($query) => $query->latest())
            ->paginate(10);
        
        return view('admin.pakets.list', compact('pakets'));
    }

    public function showGuestPackages()
    {
        $pakets = Pakets::all();
        return view('guests.dashboard', compact('pakets'));
    }

    /**
     * Menampilkan form tambah paket.
     */
    public function create()
    {
        return view('admin.pakets.create');
    }

    /**
     * Menyimpan data paket baru.
     */
    public function store(Request $request)
    {
        // Validasi input

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|integer',
            'kecepatan' => 'required|string|max:255',
        ]);
        
        Pakets::create($request->all());
        
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil ditambahkan!');
    }
    
    /**
     * Menampilkan detail paket.
     */
    public function show($id)
    {
        $paket = Pakets::findOrFail($id);
        return view('admin.pakets.show', compact('paket'));
    }

    public function pembayaran($id)
    {
        $paket = Pakets::findOrFail($id);
        return view('admin.pakets.pembayaran', compact('paket'));
    }
    
    /**
     * Menampilkan form edit paket.
     */
    public function edit(Pakets $paket)
    {
        return view('admin.pakets.edit', compact('paket'));
    }

    /**
     * Mengupdate data paket.
     */
    public function update(Request $request, Pakets $paket)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|integer',
            'kecepatan' => 'required|string|max:255',
        ]);

        $paket->update($request->all());

        return redirect()->route('pakets.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Menghapus paket.
     */
    public function destroy(Pakets $paket)
    {
        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil dihapus!');
    }
}
