<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'product_id',
        'quantity',
        'status',
    ];
}
