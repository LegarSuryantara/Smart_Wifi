<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit', 'update']),
            new Middleware('permission:create permissions', only: ['create', 'store']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
            'sort' => 'nullable|in:newest,oldest,name_asc,name_desc'
        ]);

        $permissions = Permission::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where('name', 'like', '%'.addslashes($search).'%');
            })
            ->when($validated['sort'] ?? 'name_asc', function ($query, $sort) {
                switch ($sort) {
                    case 'newest': return $query->latest();
                    case 'oldest': return $query->oldest();
                    case 'name_desc': return $query->orderByDesc('name');
                    default: return $query->orderBy('name');
                }
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.permissions.list', [
            'permissions' => $permissions,
            'filters' => $validated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:permissions,name',
                'regex:/^[\w\s\-]+$/'
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.create')
                ->withInput()
                ->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            
            Permission::create(['name' => $request->name]);
            
            DB::commit();
            
            return redirect()->route('permissions.index')
                ->with('success', 'Permission created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('permissions.create')
                ->withInput()
                ->with('error', 'Failed to create permission: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($id),
                'regex:/^[\w\s\-]+$/'
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            
            $permission->name = $request->name;
            $permission->save();
            
            DB::commit();
            
            return redirect()->route('permissions.index')
                ->with('success', 'Permission updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('permissions.edit', $id)
                ->withInput()
                ->with('error', 'Failed to update permission: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:permissions,id'
        ]);

        try {
            $permission = Permission::findOrFail($request->id);
            
            // Check if permission is assigned to any role
            if ($permission->roles()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete permission assigned to roles.'
                ], 403);
            }

            $permission->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Permission deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete permission: '.$e->getMessage()
            ], 500);
        }
    }
}