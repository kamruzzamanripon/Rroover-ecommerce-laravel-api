<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function subcategory() {
        return $this->hasMany( subcategory::class, 'category_id', 'id' );
    }

    public function products() {
        return $this->hasMany( product::class, 'category_id', 'id' );
    }
}
