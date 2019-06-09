<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request) {
        $user = User::where('email', $request->email)->first(); // Find the user by email

        if (!$user) {
            return response()->json([
                'error' => 'User does not exist.'
            ], 400);
        }

        if (Hash::check($request->password, $user->password)) {
            $payload = [
                'iss' => "jwt-test-issue",
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + 60*60
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'));

            return response()->json(['token' => $token], 200);
        }
        return response()->json([
            'error' => 'Login details provided does not exist.'
        ], 400);
    }

    public function register(Request $request) {
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = 'test';
        $user->save();

        return $user;
    }
}
