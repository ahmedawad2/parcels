<?php

namespace App\Models;


class Order extends CustomModel
{
    protected $table = 'orders';

    protected $guarded = ['id'];

    protected $dates = ['created_at'];

    public $timestamps = false;

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function currentStatus()
    {
        return $this->hasOne(OrderStatus::class)->latest();
    }
}
