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
            'code'      => substr(strtoupper(md5(rand())), 0, 4),
            'grade'     => $this->faker->randomElement(['1ro', '2do', '3ro', '4to', '5to', '6to']),
            'group'     => $this->faker->randomElement(['Grupo 01', 'Grupo 02', 'Grupo 3']),
            'name'      => $this->faker->name(),
            'last_name' => $this->faker->lastName . ' ' . $this->faker->lastName,
            //'photo'     => $this->faker->randomElement(['avatar01.png','avatar02.png']),
            'phone'     => $this->faker->phoneNumber,
            //'condition' => false,
            'users_id'  => User::inRandomOrder()->value('id'),
        ];
    }
}
