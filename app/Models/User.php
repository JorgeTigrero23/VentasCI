<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'username',
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'first_name' => 'required|min:2|max:75',
        'last_name'=> 'required|min:2|max:75',
        'phone'    => 'required|max:15',
        'username' => 'sometimes|required|max:255|unique:users',
        'name'     => 'required|max:255',
        'email'    => 'required|email|max:255',
        'password' => 'required|min:6|confirmed',
        'image'    => 'mimes:jpeg,png,bmp',
    ];

    public function options()
    {
        return $this->belongsToMany(\App\Models\Option::class, 'option_users');
    }

    public function rols()
    {
        return $this->belongsToMany(\App\Models\Rol::class, 'rol_users');
    }

    public function sales()
    {
        return $this->hasMany(\App\Model\Sale::class);
    }

}
