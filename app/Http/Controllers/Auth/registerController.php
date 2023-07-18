<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'token' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        Func::verifyRecaptha($request);

        // Create new user and save to database
        // Replace the code below with your actual user registration logic
        $user = func::createUser($request);
        // Return success response
        if ($user) {
            return response()->json(['success' => true, 'message' => 'User registered successfully.']);
        } else {
            return response()->json(['success' => true, 'false' => 'User registered failed.']);
        }
    }
}
