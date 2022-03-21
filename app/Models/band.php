<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class band extends Model {
    use HasFactory;

    public function products() {
        return $this->hasMany( product::class, 'brand_id', 'id' );
    }
}
