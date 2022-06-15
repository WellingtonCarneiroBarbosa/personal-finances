<?php

namespace App\Http\Livewire\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;

trait WithInfiniteScrolling
{
    public $nextCursor;

    public $hasMorePages;

    public function getMoreData(Builder $query, Collection $collection): void
    {
        if ($this->hasMorePages !== null && !$this->hasMorePages) {
            return;
        }

        $paginator = $query->cursorPaginate(
            perPage: 5,
            cursor: Cursor::fromEncoded($this->nextCursor)
        );

        $collection->push(...$paginator->items());

        $this->hasMorePages = $paginator->hasMorePages();
        if ($this->hasMorePages === true) {
            $this->nextCursor = $paginator->nextCursor()->encode();
        }
    }
}
