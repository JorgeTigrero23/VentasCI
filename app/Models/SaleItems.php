<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItems extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'serie',
        'sale_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function sale()
    {
        return $this->belongsTo(\App\Models\Sale::class);
    }
}
