<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'user_information', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'user_id' );
            $table->string( 'address' );
            $table->string( 'city' );
            $table->string( 'zip_code' );
            $table->string( 'mobile' );
            $table->boolean( 'shipping_alter' )->default( false );
            $table->string( 'shipping_name' )->nullable();
            $table->string( 'shipping_address' )->nullable();
            $table->string( 'shipping_city' )->nullable();
            $table->string( 'shipping_zipcode' )->nullable();
            $table->string( 'shipping_email' )->nullable();
            $table->string( 'shipping_mobile' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'user_information' );
    }
}
