<?php

namespace App\Filters\Product;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    protected array $filters;

    public function __construct()
    {
        $this->filters = [
            SearchFilter::class,
            CategoryFilter::class,
            TagFilter::class,
            PriceFilter::class,
            SortFilter::class,
        ];
    }

    public function apply(Builder $query, Request $request): Builder
    {
        foreach ($this->filters as $filter) {
            $query = app($filter)->apply($query, $request);
        }

        return $query;
    }
}
