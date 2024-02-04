<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorScheduleRequest;
use App\Http\Resources\DoctorScheduleResource;
use App\Services\DoctorScheduleService;

class DoctorScheduleController extends Controller
{
    public function __construct(private DoctorScheduleService $doctor_scheduleService)
    {
    }

    public function getAll()
    {
        $doctor_schedules = $this->doctor_scheduleService->getAll();
        return $this->successResponse(
            $this->resource($doctor_schedules, DoctorScheduleResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function find($doctor_scheduleId)
    {
        $doctor_schedule = $this->doctor_scheduleService->find($doctor_scheduleId);

        return $this->successResponse(
            $this->resource($doctor_schedule, DoctorScheduleResource::class),
            'dataFetchedSuccessfully'
        );
    }

    public function create(DoctorScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $doctor_schedule = $this->doctor_scheduleService->create($validatedData);

        return $this->successResponse(
            $this->resource($doctor_schedule, DoctorScheduleResource::class),
            'dataAddedSuccessfully'
        );
    }

    public function update(DoctorScheduleRequest $request, $doctor_scheduleId)
    {
        $validatedData = $request->validated();
        $this->doctor_scheduleService->update($validatedData, $doctor_scheduleId);

        return $this->successResponse(
            null,
            'dataUpdatedSuccessfully'
        );
    }

    public function delete($doctor_scheduleId)
    {
        $this->doctor_scheduleService->delete($doctor_scheduleId);

        return $this->successResponse(
            null,
            'dataDeletedSuccessfully'
        );
    }
}
