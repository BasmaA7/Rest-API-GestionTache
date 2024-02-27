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
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        
        $token = $user->createToken('myapptoken')->plainTextToken;
        $reponse =[
            'user'=>$user,
           'token'=>$token 
        ];
        // return new UserResource($user);
return response($reponse);
    }
}
