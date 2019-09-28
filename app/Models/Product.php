<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'barcode',
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function sale_items()
    {
        return $this->hasMany(\App\Models\SaleItem::class);
    }

}
