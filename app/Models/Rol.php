<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes;
    
    
    protected $fillable = [
        'description',
    ];
    
    protected $dates = ['deleted_at'];
    
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'rol_users');
    }
}
