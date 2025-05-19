<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Candidate::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'resume' => null, 
            'experience_level' => $this->faker->randomElement(['Junior', 'Mid', 'Senior']),
            'education' => $this->faker->sentence(),
        ];
    }
}
