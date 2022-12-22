<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            //cek apakah password yang dikirim dari postman apakah sama yang ada di database atau tidak
            $isValidPassword = Hash::check($request->password, $user->password);
            //jika passwordnya valid maka lakukan ini
            if ($isValidPassword) {
                //generate token JWT
                $token = $this->generateToken($user);
                return response()->json([
                    'token' => $token
                ]);
            }
        }
        return response()->json(['message' => "Invalid Credentials"]);
    }

    private function generateToken($user)
    {
        $jwtKey = env('JWT_KEY');
        $jwtExp = env('JWT_EXPIRED');
        $now = now()->timestamp;
        $expired = now()->addMinute($jwtExp)->timestamp;

        $payload = [
            'iat' => $now,
            'iss' => 'stream.id',
            'nbf' => $now,
            'exp' => $expired,
            'user' => $user
        ];

        $token = JWT::encode($payload, $jwtKey, 'HS256');
        return $token;
    }
}
