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
        School::factory([
            'name'  => 'IES Agropecuaria Chacaneque',
            'logo'  => 'logo_ac.png',
            'description' => 'Está ubicado en el centro poblado Chacaneque distrito de San Gaban provincia de Carabaya - región Puno ',
            'class' => '{"bg":"bg-green-500","color":"green"}'
        ])->create();
        School::factory([
            'name'  => 'IES Tupac Amaru - Coasa',
            'logo'  => 'logo_ta.png',
            'description' => 'Está ubicado en el centro poblado Tupac Amaru distrito de Coasa provincia de Carabaya - región Puno ',
            'class' => '{"bg":"bg-indigo-900","color":"indigo"}'
        ])->create();
        School::factory([
            'name'  => 'IES Miguel Grau',
            'class' => '{"bg":"bg-red-600","color":"red"}'
        ])->create();
        School::factory([
            'name'  => 'IES Pedro Paulet',
            'class' => '{"bg":"bg-blue-600","color":"blue"}'
        ])->create();

        User::factory([
            'username' => 'admin'
        ])->create();

        User::factory()->times(5)->create();
        Census::factory()->times(100)->create();
        //Candidate::factory()->times(10)->create();
    }
}
