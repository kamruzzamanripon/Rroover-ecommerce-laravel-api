<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BandFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            // 'name'        => $this->faker->company(),
            'name'        => $this->faker->randomElement( ['Nokia', 'Samsung', 'Sony', 'Wee', 'Woolmark', 'Jens & Jons', 'Taylor', 'Mcaff', 'Cocodyle', 'Lions', 'Laravel'] ),
            'description' => $this->faker->text( 150 ),
            'image'       => $this->faker->imageUrl( $width = 640, $height = 480 ),
        ];
    }
}
