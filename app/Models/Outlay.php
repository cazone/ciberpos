<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlay extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_outlay',
        'total',
        'user_id'
    ];
}
