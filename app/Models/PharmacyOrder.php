<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyOrder extends Model
{
    use HasFactory;
    protected $fillable = [
    'product_id',
    'quantity',
    'status',
];

    
    public function product() {
    return $this->belongsTo(Product::class);
}

public function staff() {
    return $this->belongsTo(Staffmember::class);
}

}
