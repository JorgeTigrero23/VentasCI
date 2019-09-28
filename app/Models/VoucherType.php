<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'quantity',
        'igv',
        'serie',
    ];

    protected $dates = ['deleted_at'];

    /* Relationship */
    
    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class);
    }

}
