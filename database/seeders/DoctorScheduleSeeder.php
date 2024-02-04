<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

        foreach ($days as $key => $day) {
            DoctorSchedule::create([
                'day'                  => $day,
                'start_time'           => '09:00',
                'end_time'             => '15:00',
                'medical_session_time' => '30',
                'doctor_id' => 2,
            ]);
        }

        foreach ($days as $key => $day) {
            DoctorSchedule::create([
                'day'                  => $day,
                'start_time'           => '09:00',
                'end_time'             => '15:00',
                'medical_session_time' => '30',
                'doctor_id' => 3,
            ]);
        }
    }
}
