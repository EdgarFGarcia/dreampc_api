<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Condition::create([
            'name'      => "Brand New"
        ]);

        Condition::create([
            'name'      => "2nd Hand"
        ]);

        Condition::create([
            'name'      => "Refurbished"
        ]);
    }
}
