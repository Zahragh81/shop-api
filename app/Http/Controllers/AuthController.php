<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validate->fails()) {
            return $this->errorResponse($validate->messages(), '422');
        }

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('myApp')->plainTextToken;

        return $this->successResponse([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->errorResponse($validate->messages(), '422');
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse('password is incorrect', '422');
        }

        $token = $user->createToken('zahra')->plainTextToken;

        return $this->successResponse([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse('logged out');
    }
}


































