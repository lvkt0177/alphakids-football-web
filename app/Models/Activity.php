<?php

namespace App\Models;

use App\Enums\ActivityCategory;
use App\Traits\HasUniqueSlug;
use App\Traits\SearchableUnaccented;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory, HasUniqueSlug, SearchableUnaccented;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'image',
        'is_featured',
        'featured_order',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'category' => ActivityCategory::class,
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('featured_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}