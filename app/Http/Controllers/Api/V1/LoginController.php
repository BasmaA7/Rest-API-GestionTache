<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate JWT token",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */

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

