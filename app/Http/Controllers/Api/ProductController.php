<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Filters\Product\ProductFilter;

class ProductController extends Controller
{
    public function index(Request $request, ProductFilter $filter)
    {
        $products = $filter->apply(
            Product::query()
                ->with(['category', 'tags'])
                ->where('is_active', true),
            $request
        )->paginate(12);

        return ProductResource::collection($products);
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProductResource($product);
    }
}
