<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SortFilter implements ProductFilterInterface
{
    protected array $allowedSorts = [

        'id_asc' => ['id', 'asc'],
        'id_desc' => ['id', 'desc'],

        'name_asc' => ['name', 'asc'],
        'name_desc' => ['name', 'desc'],

        'price_asc' => ['price', 'asc'],
        'price_desc' => ['price', 'desc'],

        'stock_asc' => ['stock', 'asc'],
        'stock_desc' => ['stock', 'desc'],

        'oldest' => ['id', 'asc'],
        'newest' => ['id', 'desc'],
    ];

    public function apply(Builder $query, Request $request): Builder
    {
        $sort = $request->get('sort');

        if (! $sort || ! isset($this->allowedSorts[$sort])) {
            return $query->orderByDesc('id');
        }

        [$column, $direction] = $this->allowedSorts[$sort];

        return $query->orderBy($column, $direction);
    }
}
