<?php

namespace Database\Factories;

use App\Enums\Rent\PaymentStatus;
use App\Enums\Rent\RentStatus;
use App\Models\Flat;
use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'lessee'         => $this->faker->word(),
            'comment'        => $this->faker->word(),
            'description'    => $this->faker->text(),
            'date_from'      => $this->faker->dateTimeBetween('now', '+1 days'),
            'date_to'        => $this->faker->dateTimeBetween('now',
                '+3 months'),
            'status'         => $this->faker->randomElement(RentStatus::class),
            'payment_status' => $this->faker->randomElement(PaymentStatus::class),
            'flat_id'        => Flat::factory(),
        ];
    }

}
