<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'amount',
        'percent',
        'product_id',
        'user_id',
        'total'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
