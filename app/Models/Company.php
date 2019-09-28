<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'Nature',
        'phone',
        'fax',
        'country',
        'city',
        'address',
        'image',
    ];
}
