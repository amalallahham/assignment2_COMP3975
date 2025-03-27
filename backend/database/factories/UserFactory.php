<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'registration_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_approved' => false,
            'role' => 'Contributor',
        ];
    }

    public function admin()
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'Admin',
            'is_approved' => true, // If you want admin users to be auto-approved
        ]);
    }
}
