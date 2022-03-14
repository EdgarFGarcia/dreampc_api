<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'          => 'Admin',
            'firstname'     => 'Admin',
            'lastname'      => "DreamPC",
            'mobilenumber'  => '09951234567',
            'email'         => 'admin@dreampc.com',
            'password'      => \Hash::make('adminpassword123'),
            'user_role'     => 1
        ]);
    }
}
