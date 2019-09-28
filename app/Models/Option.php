<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'father',
        'name',
        'description',
        'path',
        'icon_r',
        'icon_l'
    ];

    protected $dates = ['deleted_at'];

    public function users(){
        return $this->belongsToMany('App\Model\User');
    }

}
