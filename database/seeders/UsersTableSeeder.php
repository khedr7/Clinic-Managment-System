<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'id'                => 1,
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('1234567890'),
            'phone'             => '0945678321',
            'address'           => 'almazeh',
            'role'              => 'admin',
            'gender'            => 'male',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $admin->assignRole('admin');

        $doctor1 = User::create([
            'id'                => 2,
            'name'              => 'doctor no1',
            'email'             => 'doctor1@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('1234567890'),
            'phone'             => '0945674421',
            'address'           => 'almazeh',
            'role'              => 'doctor',
            'gender'            => 'male',
            'specialization_id' => '1',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $doctor1->assignRole('doctor');

        $doctor2 = User::create([
            'id'                => 3,
            'name'              => 'doctor no1',
            'email'             => 'doctor2@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('1234567890'),
            'phone'             => '0935674421',
            'address'           => 'almazeh',
            'role'              => 'doctor',
            'gender'            => 'female',
            'specialization_id' => '2',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $doctor2->assignRole('doctor');

        $user1 = User::create([
            'id'                => 4,
            'name'              => 'user no1',
            'email'             => 'user1@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('1234567890'),
            'phone'             => '0905674421',
            'address'           => 'almazeh',
            'role'              => 'user',
            'gender'            => 'female',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $user1->assignRole('user');

        $user2 = User::create([
            'id'                => 5,
            'name'              => 'user no1',
            'email'             => 'user2@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('1234567890'),
            'phone'             => '0975674421',
            'address'           => 'almazeh',
            'role'              => 'user',
            'gender'            => 'female',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        $user2->assignRole('user');
    }
}
