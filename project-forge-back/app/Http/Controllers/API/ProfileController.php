<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function updatePassword(Request $request, $id) 
    {
        $request->validate([
            'old_password'          => ['required'],
            'password'              => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
        // if($validation->fails()) {
        //     return response()->json(['message'=>$validation],500);
        // }
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return response()->json(['message'=>'Old Password Doesn\'t match!'],500);
        }   
        User::find($id)->update(['password' => Hash::make($request->password)]);
        return response()->json(['success'=>true,'message'=>'Password updated successfully!']);

    }
}
