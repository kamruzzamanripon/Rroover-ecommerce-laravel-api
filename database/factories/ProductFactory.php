<?php

namespace Database\Factories;

use App\Models\band;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $imageArray = [$this->faker->imageUrl( $width = 1600, $height = 1600 ), $this->faker->imageUrl( $width = 1600, $height = 1600 ), $this->faker->imageUrl( $width = 1600, $height = 1600 )];
        $colorArray = [$this->faker->colorName(), $this->faker->colorName(), $this->faker->colorName(), $this->faker->colorName()];
        $sizeArray = [$this->faker->randomElement( ['x', 'w', 'y', 'z'] ), $this->faker->randomElement( ['x', 'w', 'y', 'z'] ), $this->faker->randomElement( ['x', 'w', 'y', 'z'] ), $this->faker->randomElement( ['x', 'w', 'y', 'z'] )];
        return [
            'name'            => $this->faker->word(),
            'product_code'    => $this->faker->randomNumber(),
            'quantity'        => rand( 252, 756 ),
            'details'         => $this->faker->text( 150 ),
            'color'           => json_encode( $colorArray ),
            'size'            => json_encode( $sizeArray ),
            'actual_price'    => rand( 199, 756 ),
            'discount_price'  => rand( 1, 75 ),
            'best_selling'    => $this->faker->boolean(),
            'top_rating'      => $this->faker->boolean(),
            'featured'        => $this->faker->boolean(),
            'hot'             => $this->faker->boolean(),
            'sale'            => $this->faker->boolean(),
            'status'          => $this->faker->boolean( true ),
            //'image'           => $this->faker->imageUrl( $width = 640, $height = 480 ),
            'image'           => json_encode( $imageArray ),
            'category_id'     => category::all()->random()->id,
            'brand_id'        => band::all()->random()->id,
            'subcategorie_id' => subcategory::all()->random()->id,
        ];
    }
}
