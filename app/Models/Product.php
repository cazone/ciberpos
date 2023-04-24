<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_product',
        'price',
        'cost',
        'category_id',
        'description',
        'barcode',
        'code',
        'sku',
        'quantity',
        'minimum_qty',
        'unit',
        'favorite',
        'url_image'
    ];

    public function category (){
        return $this->belongsTo(Category::class);
    }

}
