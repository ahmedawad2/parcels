<?php

namespace App\Models;


class Parcel extends CustomModel
{
    protected $table = 'parcels';
    public $timestamps = false;
    protected $guarded = ['id'];
}
