<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderApi extends Model
{
    protected $primaryKey = 'orderId';

    protected $fillable = [
        'analysisId',
        'nurseId',
        'contactId',
        'totalPrice',
        'serviceName',
        'status',
        'dateOrder',
        'timeOrder',
    ];

    protected $hidden =[
        'analysisId',
        'nurseId',
        'contactId',
    ];
}
