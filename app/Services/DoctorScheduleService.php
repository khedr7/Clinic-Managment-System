<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\DoctorSchedule;

class DoctorScheduleService
{
    use ModelHelper;

    public function getAll()
    {
        return DoctorSchedule::all();
    }

    public function find($doctor_scheduleId)
    {
        return $this->findOrFail($doctor_scheduleId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        $doctor_schedule = DoctorSchedule::create($validatedData);

        DB::commit();

        return $doctor_schedule;
    }

    public function update($validatedData, $doctor_scheduleId)
    {
        $doctor_schedule = $this->findOrFail($doctor_scheduleId);

        DB::beginTransaction();

        $doctor_schedule->update($validatedData);

        DB::commit();

        return true;
    }

    public function delete($doctor_scheduleId)
    {
        $doctor_schedule = $this->find($doctor_scheduleId);

        DB::beginTransaction();

        $doctor_schedule->delete();

        DB::commit();

        return true;
    }
}
