<?php

namespace Tests\Feature\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStoreCommentForArticle()
    {
        $article = Article::factory()->create();

        $data = [
            'user' => 'test',
            'comment' => 'that was good',
        ];

        $response = $this->post(route('comments.store', $article), $data);

        $response->assertRedirect(route('articles.show', $article));
        $this->assertCount(1, $article->comments);
        $this->assertDatabaseHas('comments', [
            'article_id' => $article->id,
            'user' => $data['user'],
            'comment' => $data['comment'],
        ]);
    }

    public function testItHandlesValidationErrorsWhenStoringAComment()
    {
        $article = Article::factory()->create();

        $response = $this->post(route('comments.store', $article), []);

        $response->assertSessionHasErrors(['comment', 'user']);
    }

    public function testItLogsACommentSubmission()
    {
        $article = Article::factory()->create();
    
        $data = [
            'article' => $article->id, // Change 'article_id' to 'article'
            'user' => 'test',
            'comment' => 'that was good',
        ];
    
        $response = $this->post(route('comments.log'), $data);
    
        $response->assertJson([
            'message' => 'Log created successfully',
        ]);
    
        $this->assertDatabaseHas('logs', [
            'article_id' => $data['article'],
            'user' => $data['user'],
            'comment' => $data['comment'],
            'action' => 'Comment not submitted',
        ]);
    }
    


    public function testItDeletesAComment()
    {
        $comment = Comment::factory()->create();

        $response = $this->delete(route('comments.destroy', $comment));

        $response->assertRedirect(route('articles.show', $comment->article));
    }
}
