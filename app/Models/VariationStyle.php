<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariationStyle extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'option_image',
        'image',
        'type'
    ];
}
