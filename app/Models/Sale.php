<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'subtotal',
        'igv',
        'discount',
        'total',
        'voucher_type_id',
        'client_id',
        'user_id',
        'voucher_number',
        'serie',
    ];

    protected $dates = ['deleted_at'];

    /* Relationship */

    public function voucher_type()
    {
        return $this->belongsTo(\App\Models\VoucherType::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function sale_items()
    {
        return $this->hasMany(\App\Models\SaleItems::class);
    }

}
