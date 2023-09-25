<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contactId';

    protected $fillable = [
        'address',
        'region',
        'moreDetails',
        'userId',
    ];

}
