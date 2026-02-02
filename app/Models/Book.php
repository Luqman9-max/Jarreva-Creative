<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Model buku
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'author',
        'year',
        'category',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
