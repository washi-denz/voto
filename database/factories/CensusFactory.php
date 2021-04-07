<?php

namespace Database\Factories;

use App\Models\Census;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CensusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Census::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document'  => $this->faker->randomNumber(8),
            'code'      => $this->faker->randomNumber(4),
            'grade'     => $this->faker->randomElement(['1ro', '2do', '3ro', '4to', '5to', '6to']),
            'group'     => $this->faker->randomElement(['1', '2', '3']),
            'name'      => $this->faker->name(),
            'last_name' => $this->faker->lastName . ' ' . $this->faker->lastName,
            //'photo'     => $this->faker->username,
            //'condition' => $this->faker->username,
            'users_id'  => User::inRandomOrder()->value('id'),
        ];
    }
}
