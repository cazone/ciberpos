<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            $response =[
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('scredes')->plainTextToken;
        $response = [
            'success' => true,
            'token' => $token,
            'user' => $user,
        ];
        return response()->json($response, 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            $response =[
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            $response = [
                'success' => false,
                'message' => 'Unauthorized',
            ];
            return response()->json($response, 401);
        }
        $user = auth()->user();
        $token = $user->createToken('scredes')->plainTextToken;
        $response = [
            'success' => true,
            'token' => $token,
            'user' => $user,
        ];
        return response()->json($response, 200);

    }
}

