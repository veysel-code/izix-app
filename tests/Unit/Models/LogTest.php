<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_log()
    {
        // Create an article
        $article = Article::factory()->create();

        // Create a log
        $log = Log::create([
            'article_id' => $article->id,
            'user' => 'Test User',
            'comment' => 'Test Comment',
            'action' => 'Test Action',
        ]);

        // Assert that the log was created successfuly
        $this->assertInstanceOf(Log::class, $log);
        $this->assertEquals($article->id, $log->article_id);
        $this->assertEquals('Test User', $log->user);
        $this->assertEquals('Test Comment', $log->comment);
        $this->assertEquals('Test Action', $log->action);
    }
}
