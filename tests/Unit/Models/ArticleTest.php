<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_many_comments()
    {
        // Create article and commentaire
        $article = Article::factory()->create();
        $comment1 = Comment::factory()->create(['article_id' => $article->id]);
        $comment2 = Comment::factory()->create(['article_id' => $article->id]);

        $comments = $article->comments;

        // Test the assertiun
        $this->assertInstanceOf(Comment::class, $comments[0]);
        $this->assertInstanceOf(Comment::class, $comments[1]);
        $this->assertCount(2, $comments);
    }
}
