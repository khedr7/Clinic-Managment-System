<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        $details = $this->userService->register($validatedData);

        $details['user'] = UserResource::make($details['user']);

        return $this->successResponse($details, 'userSuccessfullySignedIn', 200);
    }

    public function login(UserRequest $request)
    {
        $validatedData = $request->validated();

        $details = $this->userService->login($validatedData);
        $details['user'] = UserResource::make($details['user']);
        return $this->successResponse($details, 'userSuccessfullySignedIn', 200);
    }

    public function logout()
    {
        $this->userService->logout();
        return $this->successResponse(
            null,
            'userSuccessfullySignedOut'
        );
    }
}
