<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TagFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        return $query->when($request->tag_id, function ($q) use ($request) {
            $q->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        });
    }
}
