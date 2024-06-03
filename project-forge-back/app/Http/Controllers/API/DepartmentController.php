<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartment;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
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

    public function searchDepartment(Request $request)
    {
        $search = $request->name;
        if($search) {
            $departments = Department::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->latest()->paginate(10);
        }else{
            $departments = Department::paginate(10);
        }
        return DepartmentResource::collection($departments);
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
