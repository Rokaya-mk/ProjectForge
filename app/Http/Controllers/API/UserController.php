<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // get users list
    public function index(){
        $users = User::with('roles','permissions')->get();
        return UserResource::collection($users);
    }
     // get user role & permissions
     public function userRolesPermissions(){
        $userPermissionRoles = [
            'roles' => auth()->user()->roles,
            'permissions' => auth()->user()->permissions,
        ];
        return response()->json($userPermissionRoles);
        
        
    }
     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        // specify data to get receive
        $data = $request->only(['name','email','password']);
        $user = User::create($data);
        if($request->input('department_id')){
            $user->departments()->attach($request->input('department_id'));
        }
        if($request->input('selected_roles')){  
            $user->roles()->attach($request->input('selected_roles'));
        }
        if($request->input('permissionValue')){
            $user->permissions()->attach($request->input('permissionValue'));
        }
        return new UserResource($user);
    }
     /**
     * Update a newly created resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name'              => 'required',  
            'email'             => 'required',
        ]);
        $updatedUser = User::findOrFail($user->id);
        $password = ($request->input('password') === null) ? $request->input('password') : Hash::make($request->input('password')) ;

        User::where('id', $user)->update([
            'name'                  => $request->input('name'),
            'password'              => $password
        ]);
        $updatedUser->departments()->sync($request->input('department_id'));
        $updatedUser->syncRoles($request->selected_roles);
        $updatedUser->syncPermissions($request->permissionValue);
        return new UserResource($updatedUser);
    }
     /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->departments()->detach();
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return response()->json(null, 204);
    }
    // get all users roles
    public function allRoles(){
        return RoleResource::collection(Role::all());
    }
    // get all permission
    public function allPermissions(){
        return PermissionResource::collection(Permission::all());
    }
}
