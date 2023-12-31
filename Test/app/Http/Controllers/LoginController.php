<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required','string'],
            'password' => ['required','string','min:6']
        ]);

        if(!Auth::attempt($request->only(['email','password']))){
            return response([
                'message' => "bad cred",
                'status' => false,
                'data' => ""
            ],200);
        }

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('loginToken')->plainTextToken;

        $resp = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json([
            'message' => "logged in successfully",
            'status' => true,
            'data' => $resp
        ],201);

    }
}
