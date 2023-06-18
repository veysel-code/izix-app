<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        try {
            // Validte the comment form data
            $validatedData = $request->validate([
                'comment' => 'required',
                'user' => 'required',
            ]);

            // Create a new comment using the Article model's relationship
            $comment = $article->comments()->create($validatedData);

            // Redirect back to the article details page
            return redirect()->route('articles.show', $article);
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function log(Request $request)
    {
        // Create a new log entry in the database
        Log::create([
            'article_id' => intval($request->article),
            'user' => $request->input('user'),
            'comment' => $request->input('comment'),
            'action' => 'Comment not submitted'
        ]);
        return response()->json(['message' => 'Log created successfully']);
    }


    public function destroy(Comment $comment)
    {
        return redirect()->route('articles.show', $comment->article);
    }
}
