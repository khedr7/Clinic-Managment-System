<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Specializations = [
            ['en' => 'Specialization no1', 'ar' => 'الاختصاص الاول'],
            ['en' => 'Specialization no2', 'ar' => 'الاختصاص الثاني'],
            ['en' => 'Specialization no3', 'ar' => 'الاختصاص الثالث'],
        ];
        $details = [
            ['en' => 'details no1', 'ar' => 'تفاصيل الاول'],
            ['en' => 'details no2', 'ar' => 'تفاصيل الثاني'],
            ['en' => 'details no3', 'ar' => 'تفاصيل الثالث'],
        ];

        foreach ($Specializations as $key => $Specialization) {
            Specialization::create([
                'id'       => $key + 1,
                'title'    => $Specialization,
                'details'  => $details[$key],
            ]);
        }
    }
}
