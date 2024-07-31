<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(Request $request): Response {

        $newUser = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        try {

            User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => bcrypt($newUser['password'])
            ]);

            return response('Usuario registrado exitosamente');

        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
