<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $dates = ['deleted_at'];

    /* Relationship */
    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class);
    }

}
