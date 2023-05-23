<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function auth(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        try {  
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['meta' => [
                    "success" =>true,
                    "error" => ['Login Invalid'],
                ]]);
            }
        } catch (JWTException $e) {
            return response()->json(['meta' => [
                "success" =>true,
                "error" => [ $e->getMessage()]
            ]],401);
        }
        return response()->json(['meta' => [
            "success" =>true,
            "error" => [
            ],
            "data" => [
                "token" => $token,
                "minutes_to_expire" => 1440

            ]
        ]]);
    }
}
