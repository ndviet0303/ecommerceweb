<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class func extends Model
{
    use HasFactory;

    public static function verifyRecaptha(Request $request)
    {
        // Verify reCAPTCHA token
        $recaptchaResponse = func::verifyRecaptcha($request->input('token'));

        if (!$recaptchaResponse['success']) {
            return response()->json(['success' => false, 'message' => 'reCAPTCHA validation failed.'], 422);
        }
    }
    public static function verifyRecaptcha($token)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $token,
        ]);

        return $response->json();
    }

    public static function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return $user;
    }
}
