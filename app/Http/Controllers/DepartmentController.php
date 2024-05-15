<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartment;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        return view('managment.departments.index', [
            'departments' => Department::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managment.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     * StoreDepartement is a request class to validate data
     */
    public function store(StoreDepartment $request)
    {
        // specify data to get receive
        $data = $request->only(['name']);
        Department::create($data);
        // add flash session 
        session()->flash('status', 'department was created !!');
        // redirect to department index
        return redirect()->route('departments.index');
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
    public function edit(string $id)
    {
        return view('managment.departments.edit', [
            'department' => Department::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartment $request, string $id)
    {
        Department::findOrFail($id)->update([
            'name' => $request->name,
        ]);
        // add flash session 
        session()->flash('status', 'department was updated !!');
        // redirect to department index
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::destroy($id);
        // add flash session 
        session()->flash('status', 'department was deleted !!');
        // redirect to department index
        return redirect()->route('departments.index');
    }
}
