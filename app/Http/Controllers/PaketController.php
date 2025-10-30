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
            new Middleware('permission:user-access', only:['index','show']),
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
            'sort' => 'nullable|in:newest,oldest,name_asc,name_desc',
            'kategori' => 'nullable|string|max:255',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
        ]);

        $pakets = Pakets::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where('nama_paket', 'like', '%'.addslashes($search).'%');
            })
            ->when($validated['kategori'] ?? null, function ($query, $kategori) {
                $query->where('kategori', $kategori);
            })
            ->when(($validated['min_price'] ?? null) !== null, function ($query) use ($validated) {
                $query->where('harga', '>=', $validated['min_price']);
            })
            ->when(($validated['max_price'] ?? null) !== null, function ($query) use ($validated) {
                $query->where('harga', '<=', $validated['max_price']);
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

        // Additional rule expected by tests: Internet category must have kecepatan like "XX Mbps"
        if (($validated['kategori'] ?? null) === 'Internet' && !preg_match('/^\d+\s?Mbps$/i', $validated['kecepatan'] ?? '')) {
            return redirect()->back()->withInput()->withErrors(['kecepatan' => 'Format kecepatan harus XX Mbps']);
        }

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

        if (($validated['kategori'] ?? null) === 'Internet' && !preg_match('/^\d+\s?Mbps$/i', $validated['kecepatan'] ?? '')) {
            return redirect()->back()->withInput()->withErrors(['kecepatan' => 'Format kecepatan harus XX Mbps']);
        }

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
            // Prevent delete if paket has active orders, return session errors as tests expect
            if (method_exists($paket, 'orders') && $paket->orders()->exists()) {
                DB::rollBack();
                return redirect()->back()->withErrors(['paket' => 'Tidak bisa menghapus paket dengan order aktif.']);
            }
            
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

    /**
     * Menghapus banyak paket sekaligus.
     */
    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:pakets,id',
        ]);

        Pakets::whereIn('id', $validated['ids'])->delete();

        return response()->json(['success' => true]);
    }
}