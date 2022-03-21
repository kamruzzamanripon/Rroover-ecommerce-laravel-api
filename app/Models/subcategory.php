<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo( category::class, 'category_id', 'id' );
    }

    public function products() {
        return $this->hasMany( product::class, 'subcategorie_id', 'id' );
    }
}
