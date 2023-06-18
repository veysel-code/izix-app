<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the index method of ArticleController.
     */
    public function testIndex()
    {
        // Create some dummy articles in the database
        Article::factory()->count(3)->create();

        // Make a GET request to the index method
        $response = $this->get('/articles');

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the returned view has the articles data
        $response->assertViewHas('articles');

        // Assert that the number of articles in the view matches the number of articles created
        $articles = $response->viewData('articles');
        $this->assertCount(3, $articles);
    }

    /**
     * Test the show method of ArticleController.
     */
    public function testShow()
    {
        // Create a dummy article
        $article = Article::factory()->create();

        // Make a GET request to the show method with the article ID as a parameter
        $response = $this->get(route('articles.show', ['article' => $article->id]));

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the returned view has the article data
        $response->assertViewHas('article');
    }

    /**
     * Test the store method of ArticleController.
     */
    public function testStore()
    {
        // Create a dumy artcle
        $data = [
            'title' => 'Test Article',
            'author' => 'John Doe',
            'content' => 'Lorem ipsum dolor sit amet',
        ];
    
        $response = $this->post('/articles/store', $data);
    
        $response->assertRedirect('/articles');
    
        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'author' => 'John Doe',
            'content' => 'Lorem ipsum dolor sit amet',
        ]);
    }
}
