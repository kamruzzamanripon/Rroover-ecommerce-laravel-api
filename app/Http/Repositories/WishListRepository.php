<?php

namespace App\Http\Repositories;

use App\Models\Favourite;
use App\Models\product;
use Illuminate\Support\Facades\Auth;

class WishListRepository {

    public function addWishList( $request ) {
        $product_id = $request->product_id ? $request->product_id : "";
        $user_id = $request->user_id ? $request->user_id : "";
        //$user_id = Auth::id();

        $check = Favourite::where( 'user_id', $user_id )->where( 'product_id', $product_id )->first();

        if ( Auth::check() ) {
            if ( !empty( $check ) ) {
                $addWishListData = [
                    'data'    => "",
                    'message' => "Product Already has on your wishlist",
                ];
                return $addWishListData;
            } else {

                $addWishList = new Favourite();

                $addWishList->user_id = Auth::id();
                $addWishList->product_id = $product_id;
                $addWishList->save();

                $addWishListData = [
                    'data'    => $addWishList,
                    'message' => "Product add your Wishlist",
                ];

                return $addWishListData;
            }
        } else {
            $addWishListData = [
                'data'    => "",
                'message' => "Please Login your Account",
            ];
            return $addWishListData;
        }

    }

    public function deleteWishProduct( $productId ) {

        if ( Auth::check() ) {
            $authId = Auth::id();
            $deleteWishProductData = Favourite::where( 'product_id', $productId )->where( 'user_id', $authId )->first();
            $deleteWishProductData->delete();

            return $deleteWishProductData;
        } else {
            $deleteWishProductData = [
                'data'    => "",
                'message' => "At First Login your Account",
            ];
            return $deleteWishProductData;
        }

    }

    public function allWishList( $request ) {
        //$user_id = $request->user_id;

        if ( Auth::check() ) {
            $user_id = Auth::id();

            $check = Favourite::where( 'user_id', $user_id )->get();
            $productIds = $check->pluck( 'product_id' )->all();
            $productInfo = product::whereIn( 'id', $productIds )->get();

            return $productInfo;

        } else {
            $addWishListData = [
                'data'    => "",
                'message' => "At First Login your Account",
            ];
            return $addWishListData;
        }
    }

}