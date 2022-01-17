<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'title'     => $this->faker->text( 25 ),
            'sub_title' => $this->faker->text( 18 ),
            'image'     => $this->faker->imageUrl( $width = 1920, $height = 720 ),
        ];
    }
}
