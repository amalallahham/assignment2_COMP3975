<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
            'create_date' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'contributor_username' => function () {
                return \App\Models\User::factory()->create([
                    'role' => 'Contributor',
                    'is_approved' => true,
                ])->email;
            },
        ];
    }
}
