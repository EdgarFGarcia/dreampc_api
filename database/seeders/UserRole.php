<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole as Role;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'position'      => 'Admin'
        ]);

        Role::create([
            'position'      => 'Worker'
        ]);
    }
}
