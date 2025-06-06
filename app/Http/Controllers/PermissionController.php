<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search parameter
        $search = $request->input('search');
        
        // Base query
        $query = Permission::query();
        
        // Apply search filter
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }
        
        // Apply sorting
        $sort = $request->input('sort', 'newest');
        
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default: // newest
                $query->latest();
                break;
        }
        
        // Paginate results
        $permissions = $query->paginate(10);
        
        return view('admin.permissions.list', compact('permissions'));
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
            'name' => 'required|unique:permissions|min:3'
        ]);
        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name  
            ]);
            return redirect()->route('permissions.index')->with('Success', 'Permission Added Successfully.');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator); 
        }
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
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);
        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('Success', 'Permission Updated Successfully.');
        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);
    
        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ]);
        }
    
        $permission->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully'
        ]);
    }
}