<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'products', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'category_id' );
            $table->string( 'brand_id' )->nullable();
            $table->string( 'subcategorie_id' )->nullable();
            $table->string( 'name' )->unique();
            $table->string( 'product_code' )->nullable();
            $table->string( 'quantity' );
            $table->text( 'details' );
            $table->string( 'color' );
            $table->string( 'size' );
            $table->float( 'actual_price', 8, 2 );
            $table->string( 'discount_price' )->nullable();
            $table->string( 'video_link' )->nullable();
            $table->boolean( 'best_selling' )->default( false );
            $table->boolean( 'top_rating' )->default( false );
            $table->boolean( 'featured' )->default( false );
            $table->boolean( 'hot' )->default( false );
            $table->boolean( 'sale' )->default( false );
            $table->string( 'image' )->nullable();
            $table->boolean( 'status' )->default( true );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'products' );
    }
}
