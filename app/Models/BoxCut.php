<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxCut extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale',
        'invoice',
        'outlay',
        'cash',
        'total',
        'user_id',
    ];
}
