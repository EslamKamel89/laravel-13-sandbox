<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table('posts')]
#[Fillable(['title', 'content', 'published'])]
class Post extends Model {
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

    #[Scope]
    protected function publish(Builder $q) {
        return $q->where('published', true);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }
    public function likedByUsers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function comments(): MorphMany {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
