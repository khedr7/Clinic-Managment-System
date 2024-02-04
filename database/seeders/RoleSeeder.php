<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'doctor', 'user'];

        foreach ($roles as $key => $role) {
            Role::create([
                'id'      => $key + 1,
                'name'    => $role,
            ]);
        }
    }
}
