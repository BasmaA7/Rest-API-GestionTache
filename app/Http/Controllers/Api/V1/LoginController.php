<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

        public function login(Request $request)
    {
        $login = $request->only('email', 'password');

        if (auth()->attempt($login)) {
            $token = auth()->user()->createToken('myapptoken')->plainTextToken;

            return response()->json(['token' => $token, 'message' => 'Connexion réussie']);
        }

        return response()->json(['message' => 'Identifiants invalides'], 401);
    }
    }

