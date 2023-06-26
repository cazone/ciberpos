<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'RFC',
        'phone',
        'email',
        'text_footer',
        'text_thanks',
        'address'

    ];
}
