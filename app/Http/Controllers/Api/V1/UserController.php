<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index(){
        //  return User::all();
        return new UserCollection(User::all());

    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
    public function store (StoreUserRequest $request){
        return new UserResource(User::create($request->all()));
    }
}
