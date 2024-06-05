<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use App\Interfaces\AuthRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepositoryInterface;
    public function __construct(AuthRepositoryInterface $authRepositoryInterface)
    {
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function register(UserRegister $request)
    {

        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($validated['password']);
            $validated['level'] = 'Employee';
            $validated['active'] = 0;
            $user = $this->authRepositoryInterface->store($validated);
            return ApiResponseClass::set200Response(new UserResource($user), 200);
        } catch (\Exception $ex) {
            return ApiResponseClass::set400Response('', 400);
        }

    }
}
