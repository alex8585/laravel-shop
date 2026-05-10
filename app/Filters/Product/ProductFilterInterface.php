<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface ProductFilterInterface
{
    public function apply(Builder $query, Request $request): Builder;
}
