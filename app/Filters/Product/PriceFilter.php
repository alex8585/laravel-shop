<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PriceFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->price_min, function ($q) use ($request) {
                $q->where('price', '>=', $request->price_min);
            })
            ->when($request->price_max, function ($q) use ($request) {
                $q->where('price', '<=', $request->price_max);
            });
    }
}
