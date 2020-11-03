<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = "peoples";
    protected $fillable = [
        'name','height','lactose','weight','athlete'
    ];
}
