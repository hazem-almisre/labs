<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $primaryKey = 'offerId';

    protected $fillable = [
        'photo',
        'labId',
        'dateEnd',

    ];

}
