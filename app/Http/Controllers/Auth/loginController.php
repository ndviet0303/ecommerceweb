<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember'))) {
            $user = User::join('role as r', 'users.user_role', '=', 'r.id')
                ->where('users.id', Auth::user()->id)
                ->select('users.*', 'r.name as role_name')
                ->first();
            $token = Auth::user()->createToken('acc-Token');
            $token = $token->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
    public function logout(Request $request)
    {
        // Auth::logout();
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    public function checkLogin(Request $request)
    {
        return response()->json(['authenticated' => true]);
    }
}
