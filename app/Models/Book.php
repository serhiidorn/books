<?php

namespace App\Models;

use App\Builders\BookBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'cover', 'published_at'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function newEloquentBuilder($query): BookBuilder
    {
        return new BookBuilder($query);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function rateBy(User $user, int $value): self
    {
        if ($this->isRatedBy($user)) {
            return $this;
        }

        $this->ratings()->create([
            'value' => $value,
            'user_id' => $user->id,
        ]);

        return $this;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isRatedBy(User $user): bool
    {
        return $this->ratings()->whereUserId($user->id)->exists();
    }

    public function commentBy(User $user, string $body): self
    {
        $this->comments()->create([
            'user_id' => $user->id,
            'body' => $body,
        ]);

        return $this;
    }
}
