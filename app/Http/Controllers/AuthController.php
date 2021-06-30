<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Models\User;


class AuthController extends Controller
{
    public function __construct()
    {
    }
    public function register(Request $req)
    {
        $register = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'api_token' => ''
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Fail',
            ], 400);
        }
    }
    public function login(Request $req)
    {
        $email = $req->email;
        $password = $req->password;

        $user = User::where('email', $email)->first();
        if (Hash::check($password, $user->password)) {
            $api_token = base64_encode(Str::random(40));

            $user->update([
                'api_token' => $api_token
            ]);

            return response()->json([
                'success' => true,
                'message' => 'login success',
                'data' => [
                    'user' => $user,
                    'api_token' => $api_token
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'login success',
                'data' => []
            ]);
        }
    }
}
