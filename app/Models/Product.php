<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'url_image',
        'notification_minimum_qty'
    ];

    public function category (){
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters) {
        if ( ! request("page")) {
            session()->put("search", $filters['search'] ?? null);

        }
        $query->when(session("search"), function ($query, $search) {
            $query->where('name_product','LIKE','%'. $search .'%')
            ->orWhere('code','LIKE','%'.$search.'%')
            ->orWhere('barcode','LIKE','%'.$search.'%');
        });
   }

}
