<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    protected $table = "product";
    protected $fillable = [
        'category_id','slug', 'title', 'description', 'price', 'image', 'weight', 'is_halal'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

}
