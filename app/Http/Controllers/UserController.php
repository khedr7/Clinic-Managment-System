<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function getAll()
    {
        $appointments = $this->userService->getAll();
        return $this->successResponse(
            $this->resource($appointments, UserResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function specializationsDoctors($id)
    {
        $appointments = $this->userService->specializationsDoctors($id);
        return $this->successResponse(
            $this->resource($appointments, UserResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($UserId)
    {
        $appointment = $this->userService->find($UserId);

        return $this->successResponse(
            $this->resource($appointment, UserResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(UserRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = $this->userService->create($validatedData);

        return $this->successResponse(
            $this->resource($appointment, UserResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(UserRequest $request, $UserId)
    {
        $validatedData = $request->validated();
        $this->userService->update($validatedData, $UserId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($UserId)
    {
        $this->userService->delete($UserId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}
