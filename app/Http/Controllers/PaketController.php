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
        return[
            new Middleware('permission:view pakets', only: ['index']),
            new Middleware('permission:edit pakets', only: ['edit']),
            new Middleware('permission:create pakets', only: ['create']),
            new Middleware('permission:delete pakets', only: ['destroy']),
        ];
    }
    /**
     * Menampilkan daftar paket.
     */
    public function index()
    {
        $pakets = Pakets::all();
        return view('admin.pakets.list', compact('pakets'));
    }

    
    public function detailPaket()
    {
        return view('UI_disini.detail_paket');
    }
    public function pembayaran()
    {
        return view('UI_disini.halaman_pembayaran');
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
    public function show(Pakets $paket)
    {
        //
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