<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word(6),
            'full_name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'province_id' => substr($this->faker->word, 0, 10),
            'district_id' => substr($this->faker->word, 0, 10),
            'ward_id' => substr($this->faker->word, 0, 10),
            'address' => $this->faker->address,
            'description' => $this->faker->optional()->text,
            'promotion' => json_encode([]),
            'cart' => json_encode([]),
            'customer_id' => $this->faker->optional()->randomNumber(),
            'guest_cookie' => $this->faker->optional()->uuid,
            'method' => $this->faker->randomElement(['cash', 'card', 'paypal']),
            'confirm' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'payment' => $this->faker->randomElement(['unpaid', 'paid']),
            'delevery' => $this->faker->randomElement(['standard', 'express']),
            'shipping' => $this->faker->randomFloat(2, 0, 50),
            'deleted_at' => null,
        ];
    }
}
