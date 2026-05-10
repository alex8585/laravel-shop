<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,

            'short_description' => $this->short_description,

            'image' => $this->image_url,


            'gallery' => collect($this->gallery)->map(function ($img) {
                return $img ? asset('storage/' . ltrim(str_replace('storage/', '', $img), '/')) : null;
            }),

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],
            'tags' => $this->tags->map(fn ($tag) => [
                'id' => $tag->id,
                'name' => $tag->name,
            ]),
        ];
    }
}
