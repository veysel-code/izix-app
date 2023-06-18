<?php

namespace App\Models;

use App\Models\DeletedComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user',
        'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\CommentFactory::new();
    }
}
