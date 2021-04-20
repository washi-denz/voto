<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\User;
use App\Models\School;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        School::factory(['name'=>'IES Agropecuaria Chacaneque'])->create();
        School::factory(['name'=>'IES Tupac Amaru - Coasa'])->create();
        School::factory()->times(4)->create();

        User::factory([
            'username' => 'admin'
        ])->create();

        User::factory()->times(5)->create();
        Census::factory()->times(100)->create();
        //Candidate::factory()->times(10)->create();
    }
}
