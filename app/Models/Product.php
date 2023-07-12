<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use LamaLama\Wishlist\Wishlistable;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, Wishlistable;
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'category_id',
        'sub_category_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'tagline',
        'description',
        'specifications',
        'category_id',
        'sub_category_id',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Creating slug from title
     *
     * @param $value
     * @return mixed
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include active category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'id','sub_category_id');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_variations');
    }

    public function variationSizes()
    {
        return $this->belongsToMany(VariationSize::class, 'product_variations');
    }

}
