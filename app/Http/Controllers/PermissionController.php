<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('managment.permissions.index', [
            'permissions'  => Permission::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managment.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // return $request->all();
        if($request->permission_type == 'basic') {
            $request->validate([
                'name'          => 'required',
                'display_name'  => 'required',
                'description'   => 'required',
            ]);

            Permission::create([
                'name'          => $request->name,
                'display_name'  => $request->display_name,
                'description'   => $request->description,
            ]);
        // add flash session 
        session()->flash('status', 'Permission created successfully!');
        }else if($request->permission_type == 'crud') {
            $request->validate([
                'resource'      => 'required',
            ]);

            $crud = $request->crudSelected;

            if(count($crud) > 0) {
                foreach($crud as $item) {
                    $name           = strtolower($request->resource) . '-' . strtolower($item);
                    $display_name   = ucwords($request->resource . ' ' . $item);
                    $description    = $display_name;

                    Permission::create([
                        'name'          => $name,
                        'display_name'  => $display_name,
                        'description'   => $description,
                    ]);
                   
                }
            }

            session()->flash('status', 'Permission created successfully!');
        }

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('managment.permissions.edit', [
            'permission' => Permission::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required',
        ]);
        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name ,
            'description' => $request->description ,
        ]);
        // add flash session 
        session()->flash('status', 'Permission was updated !!');
        // redirect to permission index
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::destroy($id);
        // add flash session 
        session()->flash('status', 'Permission was deleted !!');
        // redirect to department index
        return redirect()->route('permissions.index');
    }
}
