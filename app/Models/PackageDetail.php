<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'amount',
        'discount',
        'subtotal',
        'total',
        'package_id',
        'product_id',

    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
