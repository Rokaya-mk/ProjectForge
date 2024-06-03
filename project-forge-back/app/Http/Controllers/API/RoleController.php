<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRole;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }
    /**
     * Show a specific resource.
     */
    public function show(string $id){
        $role = Role::find($id);
        return new RoleResource($role);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRole $request)
    {
        // specify data to get receive
        $data = $request->only(['name','display_name','description',]);
        $role = Role::create($data);

        return new RoleResource($role);
    }
    public function searchRole(Request $request)
    {
        $search = $request->name;
        if($search) {
            $roles = Role::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->latest()->paginate(10);
        }else{
            $roles = Role::paginate(10);
        }
        return RoleResource::collection($roles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRole $request, string $id)
    {
        $role = Role::find($id);
        $role->update($request->all());
        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id', $id)->delete();
        return response()->json(null, 204);
    }
}
