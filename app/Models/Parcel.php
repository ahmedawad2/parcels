<?php

namespace App\Models;


class Parcel extends CustomModel
{
    protected $table = 'parcels';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function currentOrder()
    {
        return $this->hasOne(Order::class)->latest();
    }
}
