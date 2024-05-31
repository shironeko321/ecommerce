<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'cover',
        'category_id',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category_parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function category_children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
