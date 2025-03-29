<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'errors' => $validation->errors()], 422);
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        return response()->json(['success' => true, 'message' => 'User created successfully', 'user' => $user], 201);
    }

    public function login(Request $request) {
        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api token')->plainTextToken;
            return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
        }
        return response()->json(['error' => true, 'message' => 'Unauthorized'], 401);

    }

    public function logout() {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(['success' => true, 'message' => 'Logged out successfully'], 200);
    }
}
