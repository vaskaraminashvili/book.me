<?php

namespace Database\Factories;

use App\Models\Flat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlatFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flat::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title'   => strtoupper($this->faker->randomLetter()).'.'
                .$this->faker->randomNumber(1, 80),
            'status'  => $this->faker->word(),
        ];
    }

}
