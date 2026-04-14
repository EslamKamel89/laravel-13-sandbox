<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['content', 'commentable_type', 'commentable_id'])]
class Comment extends Model {
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    public function commentable(): MorphTo {
        return $this->morphTo();
    }
}
