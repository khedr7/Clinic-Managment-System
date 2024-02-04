<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService)
    {
    }

    public function getAll()
    {
        $appointments = $this->appointmentService->getAll();
        return $this->successResponse(
            $this->resource($appointments, AppointmentResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($appointmentId)
    {
        $appointment = $this->appointmentService->find($appointmentId);

        return $this->successResponse(
            $this->resource($appointment, AppointmentResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(AppointmentRequest $request)
    {
        $validatedData = $request->validated();
        $appointment = $this->appointmentService->create($validatedData);

        return $this->successResponse(
            $this->resource($appointment, AppointmentResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function updateStatus(AppointmentRequest $request, $appointmentId)
    {
        $validatedData = $request->validated();
        $this->appointmentService->updateStatus($validatedData, $appointmentId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function cancellStatus($appointmentId)
    {
        $this->appointmentService->cancellStatus($appointmentId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($appointmentId)
    {
        $this->appointmentService->delete($appointmentId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}
