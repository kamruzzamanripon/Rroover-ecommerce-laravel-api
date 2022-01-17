<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model {
    use HasFactory;

    public function category() {
        return $this->belongsTo( category::class, 'category_id', 'id' );
    }

    public function brand() {
        return $this->belongsTo( band::class, 'brand_id', 'id' );
    }

    public function subcategory() {
        return $this->belongsTo( subcategory::class, 'subcategorie_id', 'id' );
    }

    // public function similarProducts( product $product) {
    //     return product::where( 'subcategorie_id', $product->subcategorie_id )->get();
    // }
}
