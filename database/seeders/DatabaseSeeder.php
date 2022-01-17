<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\category::factory( 10 )->create();
        // \App\Models\subcategory::factory( 25 )->create();
        // \App\Models\band::factory( 11 )->create();
        // \App\Models\product::factory( 20 )->create();
        // \App\Models\banner::factory( 15 )->create();
        \App\Models\User::factory( 5 )->create();
    }
}
