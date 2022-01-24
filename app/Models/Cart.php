<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'color',
        'size',
        'quantity',
        'actual_price',
        'discount_price',
    ];

    public function product() {
        return $this->belongsTo( product::class, 'product_id', 'id' );
    }
}
