<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariations extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_variations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'variation_id',
        'variation_size_id',
        'variation_style_id',
        'price',
        'image',
        'back_image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(VariationSize::class, 'variation_size_id');
    }

    public function style()
    {
        return $this->belongsTo(VariationStyle::class, 'variation_style_id');
    }
}
