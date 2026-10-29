<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
   function readAll()
    {
        $users = User::all();

        return response()->json([
            'data' => $users,
        ], 200);
    }

    function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        return response()->json([
            'data' => $user,
        ], 201);
    }

    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->status) {
            return response()->json([
                'message' => 'Akun Anda sedang dinonaktifkan oleh Administrator.'
            ], 403);
        }

        if (!Auth::attempt(array_merge($request->only('email', 'password'), ['status' => 1]))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        if (!$user) {
            $user = User::where('email', $request->email)->firstOrFail();
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'token' => $token,
        ], 200);
    }
}
