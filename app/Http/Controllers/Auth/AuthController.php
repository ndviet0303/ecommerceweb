<?php

namespace App\Http\Controllers\Auth;

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
}
