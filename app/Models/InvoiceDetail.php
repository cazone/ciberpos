<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'amount',
        'discount',
        'subtotal',
        'total',
        'invoice_id',
        'product_id',
        'user_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
