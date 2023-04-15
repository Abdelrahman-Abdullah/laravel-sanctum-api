<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|string',
                'email'    => 'required|string|unique:users,email',
                'password' => 'required|confirmed'
            ]
        );

        // Create New User
       $new_user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
           ]);

        // Create Token For This user
        $token = $new_user->createToken($new_user->name.'-token')->plainTextToken;
        return response( [
            'user' => $new_user,
            'token'=> $token
        ],201);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|string',
                'password' => 'required'
            ]
        );

        // Check If The Email Exists Or Not
        $exist_user = User::where('email' , $request->email)->first();

        // Check The Password If The Email Is Already Exist
        if(!$exist_user || !Hash::check($request->password , $exist_user->password))
        {
            return response(
                [
                    'message' => 'Wrong Information Please Try Again '
                ] , 401
            );
        }
        // Create Token For This user
        $token = $exist_user->createToken($exist_user->name.'-token')->plainTextToken;
        return response(
            [
                'message' => 'Logged In',
                'token'   => $token
            ] , 201
        );
    }

    public function logout(Request $request)
    {
//        auth()->user()->tokens()->delete(); => Delete All Tokens
        $request->user()->currentAccessToken()->delete(); // Delete Specific Token Who make Request
        return [
            'message' => 'Logged out'
        ];
    }
}
