<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\LoginRequest;
use App\Http\Requests\v1\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterStoreRequest $request){
        $request->validated();

        $credentials = User::create([
            'id' => Str::uuid()->toString(),
            "first_name" => $request["first_name"],
            "other_name" => $request["other_name"],
            "last_name" => $request["last_name"],
            "date_of_birth" => $request["date_of_birth"],
            "country" => $request["country"],
            "state_of_origin" => $request["state_of_origin"],
            "gender" => $request["gender"],
            "mode_of_learning" => $request["mode_of_learning"],
            "course" => $request["course"],
            "email" => $request["email"],
            "password" => Hash::make($request["password"]),
        ]);

        $user = User::where('email', $credentials->email)->first();

        $user->assignRole('student');

        $token = $user->createToken('API Token', ['*'], now()->addDay())->plainTextToken;

        return response()->json([
            "message" => "success",
            "data" => $credentials,
            "token" => $token,
        ], 201);
    }

    public function login(LoginRequest $request){
        $request->validated();

        if (!Auth::attempt($request->only("email", "password"))) {

            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('API Token', ['*'], now()->addDay())->plainTextToken;

        return response()->json([
            "message" => "Logged in successfully",
            'token' => $token,
            "user" => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $token = Auth::user()->currentAccessToken()->delete();

        if ($token) {
            return response()->json([
                'message' => 'Logged out successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Unable to logout, invalid token',
        ], 403);
    }

    public function logoutAllDevices(Request $request)
    {
        $token = Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out on all devices successfully',
        ], 200);
    }
}
