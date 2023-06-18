<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Retrieve all articles from the datbase
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }
    
    public function create()
    {
        return view('articles.create');
    }

    public function show(Article $article)
    {
        // Retrieve the article details and its associated comments
        $article->load('comments');

        return view('articles.show', [
            'article' => $article,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = Article::create($data);

        return redirect('/articles')->with('success', 'Article created successfully');
    }


}
