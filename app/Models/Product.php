<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'is_active',
        'stock',
        'category_id',
        'image',
        'gallery',
    ];
    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        $disk = Storage::disk('public');

        if (!$this->image) {
            return asset('storage/placeholder.png');
        }

        $path = ltrim(str_replace('storage/', '', $this->image), '/');

        if ($disk->exists($path)) {
            return url('storage/' . $path);
        }

        return asset('storage/placeholder.png');
    }

    public function getShortDescriptionAttribute()
    {
        $text = strip_tags($this->description);
        $text = preg_replace('/\s+/', ' ', $text);

        return \Illuminate\Support\Str::limit(trim($text), 140);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
