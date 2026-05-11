<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TagFilter implements ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder
    {
        $tags = $request->get('tags');

        if (! $tags || ! is_array($tags)) {
            return $query;
        }

        return $query->whereHas('tags', function ($q) use ($tags) {

            $q->whereIn('tags.id', $tags);

        });
    }
}
