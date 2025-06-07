<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
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
            'report_category_id' => \App\Models\ReportCategory::factory(),
            'location_id' => \App\Models\Location::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'photo' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement(['pending', 'diproses', 'selesai']),
            'reported_at' => $this->faker->dateTimeThisYear(),
            'handled_at' => $this->faker->optional()->dateTimeThisYear(),
        ];
    }
}
