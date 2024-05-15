<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        return view('managment.roles.index', [
            'roles'  => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managment.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRole $request)
    {
        // specify data to get receive
        $data = $request->only(['name', 'display_name','description']);
        Role::create($data);
        // add flash session 
        session()->flash('status', 'role was created !!');
        // redirect to department index
        return redirect()->route('roles.index');
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
        return view('managment.roles.edit', [
            'role' => Role::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRole $request, string $id)
    {
        Role::findOrFail($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name ,
            'description' => $request->description ,
        ]);
        // add flash session 
        session()->flash('status', 'role was updated !!');
        // redirect to role index
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        // add flash session 
        session()->flash('status', 'role was deleted !!');
        // redirect to department index
        return redirect()->route('roles.index');
    }
}
