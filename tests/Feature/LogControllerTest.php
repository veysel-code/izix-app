<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Create a new article record
        $article = Article::create([
            'title' => 'Test Article',
            'author' => 'John Doe',
            'content' => 'Lorem ipsum dolor sit amet',
        ]);

        Log::create([
            'message' => 'Log 1',
            'article_id' => $article->id,
            'user' => 'Test User',
            'comment' => 'Test Comment',
            'action' => 'Test Action', 
        ]);

        $response = $this->get('/logs');
        $response->assertStatus(200);

        $response->assertViewHas('logs');
    }
}
