<?php

namespace Database\Factories;

use App\Models\category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            // 'name'        => $this->faker->name(),
            'name'        => $this->faker->randomElement( ['shirt', 'hoodies', 'pants', 'suits', 'shoes', 'nokia-3541', 'sumsung-4455', 'iPhone', 'Jbook & Read', 'code in mind', 'white background', 'telephone', 'jeans', 'toys', 'watches', 'ties', 'belts', 'dron', 'cars'] ),
            'description' => $this->faker->text( 150 ),
            'image'       => $this->faker->imageUrl( $width = 640, $height = 480 ),
            'category_id' => $this->faker->imageUrl( $width = 640, $height = 480 ),
            'category_id' => category::all()->random()->id,
        ];
    }
}
