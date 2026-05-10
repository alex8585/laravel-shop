<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        return $query->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }
}
