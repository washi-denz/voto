<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'logo'       => $this->faker->randomElement(['a.png', 'b.png', 'c.png']),
            'party_name' => $this->faker->text(50),
            'census_id'  => Census::inRandomOrder()->value('id'),
            'users_id'   => User::inRandomOrder()->value('id'),
        ];
    }
}
