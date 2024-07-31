<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api',['except'=> ['login']]);
    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => ' required|string|email',
            'password' => 'required|string'
        ]);

        try {
            if(!$token = Auth::attempt($credentials)){
                return response(['error' => 'Unauthorized'],401);
            }
            
            return $this->respondWithToken($token);

        } catch (\Throwable $th) {

            return response($th->getMessage());

        }

    }

    public function me() {
        return response(auth()->user());
    }

    public function logout() {
        Auth::logout();
        $cookie = Cookie::forget('token');
        return response(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

    public function refres() {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token) {
        $cookie = cookie('token',$token,60,null,null,false,true);

        return response()->json([
            'message' => 'Successfully looged in',
            'token' => $token,
        ])->withCookie($cookie);
    }
}
