<?php

namespace App\Models;


use App\Abstraction\Classes\BusinessLogic\OrderStatuses;

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

    public function scopeForBikers($query)
    {
        return $query->whereDoesntHave('orders')
            ->orWhereHas('currentOrder', function ($q) {
                $q->whereHas('currentStatus', function ($q) {
                    $q->where('status', OrderStatuses::STATUS_CANCELED);
                });
            });
    }
}
