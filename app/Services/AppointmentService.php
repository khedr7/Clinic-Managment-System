<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Traits\ModelHelper;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{
    use ModelHelper;

    public function getAll()
    {
        return Appointment::with(['user', 'doctor'])->app();
    }

    public function find($appointmentId)
    {
        return $this->findByIdOrFail(Appointment::class, 'Appointment', $appointmentId);
    }

    public function create($validatedData)
    {
        DB::beginTransaction();

        try {
            $validatedData['user_id'] = Auth::id();

            $date = Carbon::parse($validatedData['date']);

            $daySchedule = DoctorSchedule::where('doctor_id', $validatedData['doctor_id'])
                ->where('day', $date->format('l'))
                ->first();

            if (!$daySchedule) {
                throw new Exception(__('messages.Doctor is not available on this day.'), 400);
            }

            $endTime = (clone $date)->addMinutes($daySchedule->medical_session_time);

            $isWithinWorkingHours = DoctorSchedule::where('doctor_id', $validatedData['doctor_id'])
                ->where('day', $date->format('l'))
                ->where('start_time', '<', $date->format('H:i:s'))
                ->where('end_time', '>', $endTime)
                ->first();

            if (!$isWithinWorkingHours) {
                throw new Exception(__("messages.Appointment time is outside of doctor's working hours."), 400);
            }

            $isTimeAvailable = Appointment::where('doctor_id', $validatedData['doctor_id'])
                ->where('date', $date)
                ->where('status', 'Confirmed')
                ->doesntExist();

            if (!$isTimeAvailable) {
                throw new Exception(__('messages.there is an appointment in this time.'), 400);
            }

            $appointment = Appointment::create($validatedData);

            DB::commit();

            return $appointment;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStatus($validatedData, $appointmentId)
    {
        $appointment = $this->find($appointmentId);
        DB::beginTransaction();

        $user = User::where('id', Auth::id())->first();

        if (($user->role == 'admin' || $user->id == $appointment->doctor_id) && $appointment->status != 'Expired') {
            $appointment->status = $validatedData['status'];
            $appointment->save();
        } else {
            throw new Exception(__('messages.SorryYouCannotChangeTheBookingStatus'), 400);
        }

        DB::commit();

        return true;
    }

    //for user
    public function cancellStatus($appointmentId)
    {
        $appointment = $this->find($appointmentId);
        DB::beginTransaction();

        if ($appointment->user_id == Auth::id() && $appointment->status != 'Confirmed' && $appointment->status != 'Expired') {
            $appointment->status = 'Cancelled';
            $appointment->save();
        } else {
            throw new Exception(__('messages.SorryYouCannotChangeTheBookingStatus'), 400);
        }

        DB::commit();

        return true;
    }

    public function delete($appointmentId)
    {
        $appointment = $this->find($appointmentId);

        DB::beginTransaction();

        $appointment->delete();

        DB::commit();

        return true;
    }
}
