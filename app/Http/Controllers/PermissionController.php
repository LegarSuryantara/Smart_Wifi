<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(25);
        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
        ]);
        if($validator->passes()) {
            Permission::create(['name'=> $request->name  ]);
            return redirect()->route('permissions.index')->with('Success','Permission Added Successfully.');
        }else{
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
    public function edit( $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',[
            'permission'=>$permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);
        if($validator->passes()) {

            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('Success','Permission Updated Successfully.');
        }else{
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);
    
        if(!$permission){
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
