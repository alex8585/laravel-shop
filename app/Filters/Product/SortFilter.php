<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SortFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        return match ($request->sort) {

            'price_asc' => $query->orderBy('price', 'asc'),

            'price_desc' => $query->orderBy('price', 'desc'),

            'newest' => $query->orderByDesc('id'),

            default => $query->orderByDesc('id'),
        };
    }
}
