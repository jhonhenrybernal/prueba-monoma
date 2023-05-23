<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Models\Candidate;
use Domain\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    protected $model = Candidate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'source' => 'sd',
            'owner' =>  User::all()->random()->id,
            'created_at' =>  \Carbon\Carbon::now(),
            'create_by' =>  1
        ];
    }
}
