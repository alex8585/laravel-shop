<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        return $query->when($request->category_id, function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });
    }
}
