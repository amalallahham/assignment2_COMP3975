<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
            'create_date' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'contributor_username' => function () {
                return User::factory()->create([
                    'role' => 'Contributor',
                    'is_approved' => true,
                ])->username;
            },
        ];
    }
}
