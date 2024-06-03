<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermission;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PermissionResource::collection(Permission::paginate(8));
        
    }
    // search permission
    public function searchPermission(Request $request)
    {
        
        $search = $request->name;
        if($search) {
            $permissions = Permission::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->latest()->paginate(10);
        }else{
            $permissions = Permission::paginate(10);
        }
        return response()->json($permissions);
        return PermissionResource::collection($permissions);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //   return $request->all();
         if($request->permission_type == 'basic') {
            $request->validate([
                'name'          => 'required',
                'display_name'  => 'required',
                'description'   => 'required',
            ]);

            $permission= Permission::create([
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

            $crud = $request->selectedCrud;

            if(count($crud) > 0) {
                foreach($crud as $item) {
                    $name           = strtolower($request->resource) . '-' . strtolower($item);
                    $display_name   = ucwords($request->resource . ' ' . $item);
                    $description    = $display_name;

                    $permission= Permission::create([
                        'name'          => $name,
                        'display_name'  => $display_name,
                        'description'   => $description,
                    ]);
                   
                }
            }

        }

        return new PermissionResource($permission);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePermission $request, string $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->all());
        return new PermissionResource($permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::where('id', $id)->delete();
        return response()->json(null, 204);
    }
}
