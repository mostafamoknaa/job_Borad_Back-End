<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
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
            'company_name' => $this->faker->company,
            'industry' => $this->faker->randomElement(['IT', 'Finance', 'Healthcare', 'Education']),
            'website' => $this->faker->url,
            'company_size' => $this->faker->randomElement(['1-10', '11-50', '51-200', '200+']),
            'company_logo' => null, 
            'company_description' => $this->faker->paragraph,
        ];
    }
}
