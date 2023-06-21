<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4|max:10'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        if (!$user) {
            $data = [
                'message' => 'Error',
                'error' => 'Registration not completed'
            ];
            return response()->json($data, 400);
        }
        return response()->json(
            [
                'message' => 'Success',
                'error' => 'Registration completed',
                'User'=>$user
            ],
            400
        );
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $data = [
                'message' => 'Success',
                'token' => $token,
                'user'=> $user
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Error',
                'error' => 'Invalid credentials'
            ];
            return response()->json($data, 401);
        }
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        $data = [
            'message' => 'log outed',
            'token' => 'token remove'
        ];
        return response()->json(
            $data,
            401
        );
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|max:10|confirmed',
        ]);
        // Verify the current password
        if (!password_verify($validatedData['current_password'], $user->password)) {
            $data = [
                'message' => 'Error',
                'error' => 'Current password is incorrect',
            ];
            return response()->json($data, 400);
        }

        // Update the password
        $user->password = bcrypt($validatedData['new_password']);
        $user->save();

        $data = [
            'message' => 'Success',
            'user'=> $user->name,
            'error' => 'Password changed successfully'
        ];
        return response()->json($data, 200);
    }

}
