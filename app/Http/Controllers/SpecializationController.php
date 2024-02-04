<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationRequest;
use App\Http\Resources\SpecializationResource;
use App\Services\SpecializationService;

class SpecializationController extends Controller
{
    public function __construct(private SpecializationService $specializationService)
    {
    }

    public function getAll()
    {
        $specializations = $this->specializationService->getAll();
        return $this->successResponse(
            $this->resource($specializations, SpecializationResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($specializationId)
    {
        $specialization = $this->specializationService->find($specializationId);

        return $this->successResponse(
            $this->resource($specialization, SpecializationResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(SpecializationRequest $request)
    {
        $validatedData = $request->validated();
        $specialization = $this->specializationService->create($validatedData);

        return $this->successResponse(
            $this->resource($specialization, SpecializationResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(SpecializationRequest $request, $specializationId)
    {
        $validatedData = $request->validated();
        $this->specializationService->update($validatedData, $specializationId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($specializationId)
    {
        $this->specializationService->delete($specializationId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}
