<?php

namespace App\Models;


class OrderStatus extends CustomModel
{
    protected $table = 'order_status';

    protected $guarded = ['id'];

    protected $dates = ['created_at'];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
