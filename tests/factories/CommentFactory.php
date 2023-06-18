<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'comment' => $this->faker->sentence,
            'author' => $this->faker->name,
            'article_id' => function () {
                return \App\Models\Article::factory()->create()->id;
            },
        ];
    }
}
