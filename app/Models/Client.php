<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'client_type_id',
        'document_type_id',
        'document_number',
        'phone',
        'mail',
        'address',
    ];

    protected $dates = ['deleted_at'];

    //Relationship
    public function client_type()
    {
        return $this->belongsTo(\App\Models\ClientType::class, 'client_type_id');
    }

    public function document_type()
    {
        return $this->belongsTo(\App\Models\DocumentType::class, 'document_type_id');
    }

    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class);
    }

}
