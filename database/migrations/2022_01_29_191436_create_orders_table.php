<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'invoice_no' );
            $table->string( 'user_id' );
            $table->string( 'product_id' );
            $table->string( 'quantity' );
            $table->string( 'color' );
            $table->string( 'size' );
            $table->string( 'actual_price' );
            $table->string( 'discount_price' );
            $table->string( 'total_price' );
            $table->string( 'payment_method' );
            $table->boolean( 'payment_status' )->default( false );
            $table->string( 'payment_trx' )->nullable();
            $table->string( 'order_date' );
            $table->string( 'order_time' );
            $table->enum( 'order_status', ['1', '2', '3'] );
            $table->string( 'note' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'orders' );
    }
}
