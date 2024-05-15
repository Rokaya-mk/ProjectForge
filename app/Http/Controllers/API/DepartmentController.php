<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartment;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
         return DepartmentResource::collection(Department::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartment $request)
    {

        // specify data to get receive
        $data = $request->only(['name']);
        $department = Department::create($data);

        return new DepartmentResource($department);
        // return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartment $request, string $id)
    {
        $department = Department::find($id);
        $department->update($request->all());
        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::where('id', $id)->delete();
        return response()->json(null, 204);
    }
}
