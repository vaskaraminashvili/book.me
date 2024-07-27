<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Rent;

class RentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rent::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'lessee' => $this->faker->word(),
            'comment' => $this->faker->word(),
            'description' => $this->faker->text(),
            'date_from' => $this->faker->date(),
            'date_to' => $this->faker->date(),
            'status' => $this->faker->word(),
            'payment_status' => $this->faker->word(),
            'flat_id' => $this->faker->word(),
        ];
    }
}
