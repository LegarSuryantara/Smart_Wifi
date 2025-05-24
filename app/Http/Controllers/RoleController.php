<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort', 'newest');
        
        $roles = Role::with('permissions')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->when($sort, function ($query) use ($sort) {
                switch ($sort) {
                    case 'oldest':
                        return $query->oldest();
                    case 'name_asc':
                        return $query->orderBy('name', 'asc');
                    case 'name_desc':
                        return $query->orderBy('name', 'desc');
                    default: // newest
                        return $query->latest();
                }
            })
            ->paginate(10)
            ->withQueryString();
        
        return view('admin.roles.list', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('admin.roles.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                
                $role = Role::create(['name' => $request->name]);

                if (!empty($request->permissions)) {
                    $role->syncPermissions($request->permissions);
                }
                
                DB::commit();
                
                return redirect()->route('roles.index')->with('success', 'Role added successfully.');
                
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('roles.create')
                    ->withInput()
                    ->with('error', 'Failed to create role: '.$e->getMessage());
            }
        } else {
            return redirect()->route('roles.create')
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::orderBy('name','ASC')->get();

        return view('admin.roles.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.',id|min:3',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                
                $role->name = $request->name;
                $role->save();

                if (!empty($request->permissions)) {
                    $role->syncPermissions($request->permissions);
                } else {
                    $role->syncPermissions([]);
                }
                
                DB::commit();
                
                return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
                
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('roles.edit', $id)
                    ->withInput()
                    ->with('error', 'Failed to update role: '.$e->getMessage());
            }
        } else {
            return redirect()->route('roles.edit', $id)
                ->withInput()
                ->withErrors($validator);
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
            
            // Prevent deletion of admin role or roles with users
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