<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = ['user_id', 'book_id', 'value'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
