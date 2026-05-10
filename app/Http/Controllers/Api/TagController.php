<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(
            Tag::orderBy('name')->get()
        );
    }
}

