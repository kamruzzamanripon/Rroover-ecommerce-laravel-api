<?php

namespace App\Http\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository {

    public function addCart( $request ) {
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity ? $request->quantity : 1;
        $actual_price = $request->actual_price;
        $discount_price = $request->discount_price;

        $check = Cart::where( 'user_id', $user_id )->where( 'product_id', $product_id )->orderBy( 'id', 'desc' )->first();

        if ( Auth::check() ) {
            if ( !empty( $check ) ) {

                if ( $check->color !== $color || $check->size !== $size ) {
                    $addCartData = new Cart();

                    $addCartData->user_id = Auth::id();
                    $addCartData->product_id = $product_id;
                    $addCartData->color = $color;
                    $addCartData->size = $size;
                    $addCartData->quantity = $quantity;
                    $addCartData->actual_price = $actual_price;
                    $addCartData->discount_price = $discount_price;
                    $addCartData->save();

                    $addCartListData = [
                        'data'    => $addCartData,
                        'message' => "Product add your Cart",
                    ];

                    return $addCartListData;
                } else {
                    $addCartData = [
                        'data'    => "",
                        'message' => "Product Already has on your Cart",
                    ];
                    return $addCartData;
                }

            } else {

                $addCartData = new Cart();

                $addCartData->user_id = Auth::id();
                $addCartData->product_id = $product_id;
                $addCartData->color = $color;
                $addCartData->size = $size;
                $addCartData->quantity = $quantity;
                $addCartData->actual_price = $actual_price;
                $addCartData->discount_price = $discount_price;
                $addCartData->save();

                $addCartListData = [
                    'data'    => $addCartData,
                    'message' => "Product add your Cart",
                ];

                return $addCartListData;
            }
        } else {
            $addCartListData = [
                'data'    => "",
                'message' => "Please Login your Account",
            ];
            return $addCartListData;
        }
    }

    public function cartList() {

        if ( Auth::check() ) {
            $user_id = Auth::id();

            $cartListData = Cart::where( 'user_id', $user_id )->with( 'product' )->get();

            return $cartListData;

        } else {
            $cartListData = [
                'data'    => "",
                'message' => "At First Login your Account",
            ];
            return $cartListData;
        }
    }

    public function updateCart( $request ) {
        $product_id = $request->product_id;
        $quantity = $request->quantity ? $request->quantity : 1;

        if ( Auth::check() ) {
            $user_id = Auth::id();

            $updateCartData = Cart::where( 'user_id', $user_id )->where( 'product_id', $product_id )->with( 'product' )->first();

            $updateCartData->quantity = $quantity;
            $updateCartData->update();

            $cartListData = [
                'data'    => $updateCartData,
                'message' => "Please Login your Account",
            ];
            return $cartListData;

        } else {
            $cartListData = [
                'data'    => "",
                'message' => "At First Login your Account",
            ];
            return $cartListData;
        }

    }

    public function deleteCart( $productId ) {

        if ( Auth::check() ) {
            $authId = Auth::id();
            $deleteCartData = Cart::where( 'product_id', $productId )->where( 'user_id', $authId )->first();
            $deleteCartData->delete();

            return $deleteCartData;
        } else {
            $deleteCartData = [
                'data'    => "",
                'message' => "At First Login your Account",
            ];
            return $deleteCartData;
        }
    }
}