<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LogController;

// Route for listing articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Route for displaying article details
Route::get('/articles/show/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Route for adding article 
// Route::post('/articles', [ArticleController::class, 'store']);

// Route for adding article on a page
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');


// Route for creating a comment on an article
Route::post('/comments/store/{article}', [CommentController::class, 'store'])->name('comments.store');

// Route to check the deleted comment
Route::post('/comments/log', [CommentController::class, 'log'])->name('comments.log');

// Route to check all logs
Route::get('/logs', [LogController::class, 'index'])->name('logs.index');


// Route for deleting a comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');