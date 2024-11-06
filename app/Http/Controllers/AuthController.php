<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        // Validate the request
        $request->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);

        // login attempt
        $email = $request->input('email');
        $password = $request->input('password');
        $attempt = auth()->attempt(['email' => $email, 'password' => $password]);
        if (!$attempt) {
            return ApiResponse::unauthorized();
        }

        //authenticate the user
        $user = auth()->user();

        // // metodo createToken só aparece porque no model user tem o use HasApiTokens
        // // assume o tempo de expiração que está configurando no Sanctum
        // $token = $user->createToken($user->name)->plainTextToken;

        // Definindo o tem de expiração do token
        $token = $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;

        // return the access token for the api requests
        return ApiResponse::success([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logout with successfully');
    }
}
