<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\Equipment;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startDate = fake()->dateTimeBetween('now', '+1 month');

        return [

            /**
             * prompt: comment generer deux date de debut de fin dabs factory pour tester
             *
            */
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => (clone $startDate)->modify('+'.fake()->numberBetween(1, 7).' days')->format('Y-m-d'),

            'totalPrice' => fake()->randomFloat(2, 10, 500),
            'userId' => User::inRandomOrder()->value('id'),
            'equipment_id' => Equipment::inRandomOrder()->value('id'), //inRandomOrder sert a choir un equiment aleatroiment
        ];
    }
}
