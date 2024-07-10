<?php

namespace App\Actions;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class GetBooksByRequest
{
    public function handle(array $requestQuery = [])
    {
        return Book::query()
            ->withAvg('ratings as rating', 'value')
            ->when($requestQuery['search'] ?? false, function (Builder $query, string $search) {
                $query->search($search);
            })
            ->when($requestQuery['sort'] ?? false, function (Builder $query, string $sorter) {
                $query->sort($sorter);
            })
            ->latest()
            ->paginate(10);
    }
}
