<?php

namespace App\Http\Repositories;

use App\Models\Favourite;
use App\Models\product;

class CartRepository {

    public function addWishList( $request ) {
        $product_id = $request->product_id;
        $user_id = "6";
        //$user_id = Auth::id();

        $check = Favourite::where( 'user_id', $user_id )->where( 'product_id', $product_id )->first();

        //if ( Auth::check() ) {
        if ( $check ) {
            $addWishListData = [
                'data'    => "",
                'message' => "Product Already has on your wishlist",
            ];
            return $addWishListData;
        } else {
            $addWishList = new Favourite();

            $addWishList->user_id = $request->user_id;
            $addWishList->product_id = $request->product_id;
            $addWishList->save();

            $addWishListData = [
                'data'    => $addWishList,
                'message' => "",
            ];

            return $addWishListData;
        }
        // } else {
        //     $addWishListData = [
        //         'data'    => "",
        //         'message' => "At First Login your Account",
        //     ];
        //     return $addWishListData;
        // }

    }

    public function allWishList( $request ) {
        $user_id = $request->user_id;
        //$user_id = Auth::id();

        $check = Favourite::where( 'user_id', $user_id )->get();
        $productIds = $check->pluck( 'product_id' )->all();
        $productInfo = product::whereIn( 'id', $productIds )->get();

        return $productInfo;
    }

}