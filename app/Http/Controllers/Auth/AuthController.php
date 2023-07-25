<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function changePassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'curr_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->curr_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác.'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công.']);
    }

    public function user(Request $request)
    {
        $user = User::join('role as r', 'users.user_role', '=', 'r.id')
            ->where('users.id', $request->user()->id)
            ->select('users.*', 'r.name as role_name')
            ->first();
        return response()->json(['user' =>  $user]);
    }
}
