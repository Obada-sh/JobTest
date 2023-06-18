<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try
        {
            $fields = $request->validate([
                'name' => 'bail|required|string',
                'email' => 'bail|required|string|unique:users,email',
                'password' => 'bail|required|confirmed|string|min:6',
                'role' =>'bail|required|in:Admin,User',
                'birth_date' => ['bail','required', 'date', function ($attribute, $value, $fail) {
                    $minimumAge = 18;
                    $birthday = Carbon::parse($value);
                    $age = $birthday->diffInYears(\Carbon\Carbon::now());

                    if ($age < $minimumAge) {
                        $fail('You must be at least 18 years old.');
                    }
                }],
            ]);
        }catch(Exception $e){
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status' => false,
                    'data' => ""
                ]
            ,200 );
        }

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
            'role'=>$fields['role'],
        ]);

        $token = $user->createToken('loginToken')->plainTextToken;
            $response = [
                'user'=>$user,
                'token'=>$token
            ];
            return response()->json(
                [
                    'message' => "registered successfully",
                    'status' => true,
                    'data' => $response
                ]
            ,201 );

    }
}
