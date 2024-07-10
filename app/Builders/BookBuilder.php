<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class BookBuilder extends Builder
{
    public function search(string $searchTerm)
    {
        $this->query->whereAny(['title', 'author'], 'like', "%$searchTerm%");

        return $this;
    }

    public function sort(string $sorter)
    {
        $column = $sorter;
        $dir = 'asc';

        if (str_starts_with($sorter, '-')) {
            $column = substr($sorter, 1);
            $dir = 'desc';
        }

        if (! in_array($column, ['title', 'rating'])) {
            return $this;
        }

        $this->query->orderBy($column, $dir);

        return $this;
    }
}
