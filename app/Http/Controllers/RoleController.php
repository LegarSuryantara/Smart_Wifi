<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
            new Middleware('permission:create roles', only: ['create', 'store']),
            new Middleware('permission:delete roles', only: ['destroy']),
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

        $roles = Role::with('permissions')
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

        return view('admin.roles.list', [
            'roles' => $roles,
            'filters' => $validated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create', [
            'permissions' => Permission::orderBy('name')->get()
        ]);
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
                'unique:roles,name',
                'regex:/^[\w\s\-]+$/'
            ],
            'permission' => 'nullable|array',
            'permission.*' => [
                'string',
                Rule::exists('permissions', 'name')
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $role = Role::create(['name' => $request->name]);
            
            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            }

            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully.');
                
        } catch (\Exception $e) {
            return redirect()->route('roles.create')
                ->withInput()
                ->with('error', 'Failed to create role: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::orderBy('name')->get(),
            'hasPermissions' => $role->permissions->pluck('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('roles', 'name')->ignore($id),
                'regex:/^[\w\s\-]+$/'
            ],
            'permission' => 'nullable|array',
            'permission.*' => [
                'string',
                Rule::exists('permissions', 'name')
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $role->name = $request->name;
            $role->save();
            
            $role->syncPermissions($request->permission ?? []);

            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->route('roles.edit', $id)
                ->withInput()
                ->with('error', 'Failed to update role: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:roles,id'
        ]);

        try {
            $role = Role::findOrFail($request->id);
            
            if ($role->name === 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete admin role.'
                ], 403);
            }

            if ($role->users()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete role with assigned users.'
                ], 403);
            }

            $role->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Role deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete role: '.$e->getMessage()
            ], 500);
        }
    }
}