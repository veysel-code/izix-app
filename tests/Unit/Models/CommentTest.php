<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_an_article()
    {
        // Create an article
        $article = Article::factory()->create();

        // Create a comment
        $comment = Comment::factory()->create([
            'article_id' => $article->id,
        ]);

        // Retrieve the associated article from the comment
        $associatedArticle = $comment->article;

        // And the check
        $this->assertInstanceOf(Article::class, $associatedArticle);
        $this->assertEquals($article->id, $associatedArticle->id);
    }
}
