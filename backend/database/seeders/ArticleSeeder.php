<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $start = Carbon::now();
            $end = (clone $start)->addDays(rand(1, 10));

            Article::create([
                'title' => 'Sample Article ' . $i,
                'body' => "
                    <h2>Heading for Article $i</h2>
                    <p>This is a <strong>sample article</strong> body with some <em>HTML formatting</em>.</p>
                    <ul>
                        <li>First point</li>
                        <li>Second point</li>
                        <li>Third point</li>
                    </ul>
                    <p>More content to make this article look real.</p>
                ",
                'create_date' => Carbon::now(),
                'start_date' => $start,
                'end_date' => $end,
                'contributor_username' => 'user_' . rand(1, 100),
            ]);
        }
    }
}
