<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'rateId';

    protected $fillable = [
        'rate',
        'opinion',
        'orderId',
    ];

    protected $hidden=[
        'orderId'
    ];
}
