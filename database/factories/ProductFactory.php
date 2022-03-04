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
        //$imageArray = [$this->faker->imageUrl( $width = 1600, $height = 1600 ), $this->faker->imageUrl( $width = 1600, $height = 1600 ), $this->faker->imageUrl( $width = 1600, $height = 1600 )];
        $imageArray = [
            "https://images.unsplash.com/photo-1643665587758-f615a93aa951?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=736&q=80",
            "https://images.unsplash.com/photo-1643488671799-316650959950?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80",
            "https://images.unsplash.com/photo-1586179405184-1158419ffe2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1636831993349-5f1511e38b74?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80",
            "https://images.unsplash.com/photo-1619933317484-5f142f791902?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80",
            "https://images.unsplash.com/photo-1643226355493-88c7ad283155?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80",
            "https://images.unsplash.com/photo-1643285803934-157d245e468c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
            "https://images.unsplash.com/photo-1642977130245-f3b6582b919f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1639306425355-7fd84115c249?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1642979896299-10b286cf7b71?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80",
            "https://images.unsplash.com/photo-1642867471627-634f75fdefaa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=683&q=80",
            "https://images.unsplash.com/photo-1642999743456-f7073a0b2d9c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1636653569909-8190ce3b4280?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1642439048934-27a82f89b866?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80",
            "https://images.unsplash.com/photo-1642443919368-586139cd2d07?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
            "https://images.unsplash.com/photo-1641977937814-160ab3062a23?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
            "https://images.unsplash.com/photo-1642441463496-1dfd2fb67283?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1642290460481-76a5f2e18c3e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
            "https://images.unsplash.com/photo-1642410259687-2ac419ddf4e5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
            "https://images.unsplash.com/photo-1642383015790-73cddc7fb5bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=686&q=80",
            "https://images.unsplash.com/photo-1635695577677-ef36a8b481fa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80",
            "https://images.unsplash.com/photo-1641977957375-d1dae647ce17?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
            "https://images.unsplash.com/photo-1634283715079-d91bbed0ece0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80",
            "https://images.unsplash.com/photo-1639544522410-99ac1266335a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1641997465126-c73cc4070337?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
            "https://images.unsplash.com/photo-1642015555291-c3711ba56e04?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80",
            "https://images.unsplash.com/photo-1640264974125-ce9c3ebcfe22?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80",
        ];
        $rand_keys = array_rand( $imageArray, 3 );
        
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
            //'image'           => json_encode( $imageArray ),

            'image'           => json_encode( [$imageArray[$rand_keys[0]], $imageArray[$rand_keys[1]], $imageArray[$rand_keys[2]]] ),
            'category_id'     => category::all()->random()->id,
            'brand_id'        => band::all()->random()->id,
            'subcategorie_id' => subcategory::all()->random()->id,
        ];
    }
}
