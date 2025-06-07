<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostFoundItem>
 */
class LostFoundItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'type' => $this->faker->randomElement(['lost', 'found']),
            'item_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category' => $this->faker->optional()->word,
            'photo' => $this->faker->optional()->imageUrl(),
            'date' => $this->faker->dateTimeThisYear(),
            'lost_status' => $this->faker->optional()->randomElement(['not_found', 'found']),
            'found_status' => $this->faker->optional()->randomElement(['not_claimed', 'claimed']),
        ];
    }
}
