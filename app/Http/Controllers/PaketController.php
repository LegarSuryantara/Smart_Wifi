<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaketController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view pakets', only: ['index']),
            new Middleware('permission:edit pakets', only: ['edit', 'update']),
            new Middleware('permission:create pakets', only: ['create', 'store']),
            new Middleware('permission:delete pakets', only: ['destroy']),
        ];
    }

    /**
     * Menampilkan daftar paket.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255|regex:/^[\p{L}\p{N}\s\-]+$/u',
            'sort' => 'nullable|in:newest,oldest,name_asc,name_desc'
        ]);

        $pakets = Pakets::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where('nama_paket', 'like', '%'.addslashes($search).'%');
            })
            ->when($validated['sort'] ?? 'newest', function ($query, $sort) {
                switch ($sort) {
                    case 'oldest': return $query->oldest();
                    case 'name_asc': return $query->orderBy('nama_paket');
                    case 'name_desc': return $query->orderByDesc('nama_paket');
                    default: return $query->latest();
                }
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.pakets.list', [
            'pakets' => $pakets,
            'filters' => $validated
        ]);
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
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255|unique:pakets,nama_paket',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kecepatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            Pakets::create($validated);
            
            DB::commit();
            
            return redirect()->route('pakets.index')
                ->with('success', 'Paket berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pakets.create')
                ->withInput()
                ->with('error', 'Gagal menambahkan paket: '.$e->getMessage());
        }
    }
    
    /**
     * Menampilkan detail paket.
     */

         public function show($id)
    {
        $paket = Pakets::findOrFail($id);
        return view('admin.pakets.pembayaran', compact('paket'));
    }

    // public function show($id)
    // {
    //     $paket = Pakets::findOrFail($id);
    //     return view('admin.pakets.show', compact('paket'));
    // }

    // public function pembayaran($id)
    // {
    //     $paket = Pakets::findOrFail($id);
    //     return view('admin.pakets.pembayaran', compact('paket'));
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
        $validated = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pakets', 'nama_paket')->ignore($paket->id)
            ],
            'kategori' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'kecepatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            $paket->update($validated);
            
            DB::commit();
            
            return redirect()->route('pakets.index')
                ->with('success', 'Paket berhasil diperbarui!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pakets.edit', $paket)
                ->withInput()
                ->with('error', 'Gagal memperbarui paket: '.$e->getMessage());
        }
    }

    /**
     * Menghapus paket.
     */
    public function destroy(Pakets $paket)
    {
        try {
            DB::beginTransaction();
            
            $paket->delete();
            
            DB::commit();
            
            return redirect()->route('pakets.index')
                ->with('success', 'Paket berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pakets.index')
                ->with('error', 'Gagal menghapus paket: '.$e->getMessage());
        }
    }
}