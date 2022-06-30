<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkout>
 */
class CheckoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'camp_id' => $this->faker->unique()->randomElement([1, 2]),
            'card_number' => $this->faker->randomNumber(mt_rand(8, 10)),
            'expired' => Carbon::now()->addMonth(mt_rand(1, 3)),
            'cvc' => $this->faker->randomNumber(3),
            'is_paid' => 0
        ];
    }
}
