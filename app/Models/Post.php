<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table('posts')]
#[Fillable(['title', 'content', 'published', 'metadata', 'status'])]
class Post extends Model {
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

    #[Scope]
    protected function publish(Builder $q) {
        return $q->where('published', true);
    }
    protected function casts() {
        return [
            'published' => 'boolean',
            'metadata' => AsArrayObject::class,
            'status'  => PostStatus::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function title(): Attribute {
        return Attribute::make(
            get: function (string $val) {
                return ucfirst($val);
            },
            set: function (string $val) {
                return strtolower($val);
            }
        );
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
