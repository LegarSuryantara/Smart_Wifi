<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use Illuminate\Http\Request;

class adminPaketsController extends Controller
{
    /**
     * Menampilkan daftar paket.
     */
    public function index()
    {
        $pakets = Pakets::all();
        return view('admin.pakets.index', compact('pakets'));
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

    // /**
    //  * Menampilkan detail paket.
    //  */
    // public function show(Pakets $paket)
    // {
    //     return view('pakets.show', compact('paket'));
    // }

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
