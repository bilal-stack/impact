<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'coupon_id',
        'discount',
        'amount',
        'final_amount',
        'status',
        'email',
        'country',
        'address',
        'state',
        'city',
        'zip',
        'phone',
        'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Creating order_number
     *
     */
    public function setOrderNumberAttribute()
    {
        $this->attributes['order_number'] = Str::uuid();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'order_number';
    }

    /**
     * Get the user that owns the activation.
     */
    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}