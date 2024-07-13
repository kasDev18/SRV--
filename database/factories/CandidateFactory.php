<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Language;
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

    public function definition(): array
    {
        //generate random array element from given array

        return [
            'email' => $this->faker->unique()->safeEmail,
            'telephone_number' => $this->faker->phoneNumber,
            'phone_number' => $this->faker->phoneNumber,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date(),
            'position' => $this->faker->jobTitle,
            'languages' => $this->faker->randomElements(Language::pluck('id')->toArray(), Language::count()),
            'driving_license' => false, // For now, as it's nullable
            'cv' => null, // For now, as it's nullable
            'own_transport' => $this->faker->boolean,
            'is_working' => $this->faker->randomElement([0, 1, 2, 3]), // Randomly assign is_working value
            'projects'=>[
                [
                    'title' => $this->faker->sentence,
                    'description' => $this->faker->sentence,
                    'url' => $this->faker->url,
                    'start_date' => $this->faker->date(),
                    'end_date' => $this->faker->date(),
                ]
            ]
        ];
    }
}
