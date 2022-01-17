<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            // 'name'        => $this->faker->word(),
            'name'        => $this->faker->randomElement( ['Men\'s clothing', 'Woments\'s clothing', 'Toys Hobbies & Robot', 'Mobiles & tablets', 'Books & Audible', 'Beauty & Helath'] ),
            'description' => $this->faker->text( 150 ),
            'image'       => $this->faker->imageUrl( $width = 640, $height = 480 ),
        ];
    }
}
