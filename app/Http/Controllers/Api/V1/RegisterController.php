<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
* @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
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
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        
        $token = $user->createToken('myapptoken')->plainTextToken;
        $reponse =[
            'user'=>$user,
           'token'=>$token 
        ];
        // return new UserResource($user);
return response($reponse,201);
    }


  /**
 * @OA\Post(
 *     path="/api/logout",
 *     summary="Logout the user",
 *     @OA\Response(
 *         response="200",
 *         description="Logout successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Logout successful")
 *         )
 *     ),
 *     @OA\Response(
 *         response="401",
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     ),
 * )
 */
    public function logout(Request $request)
{
    auth()->user()->tokens()->delete();
    
    return [
        'message' => 'Logout With seccess'
    ];
}
}
