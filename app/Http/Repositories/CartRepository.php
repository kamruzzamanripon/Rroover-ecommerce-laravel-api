<?php

namespace App\Http\Repositories;

use App\Models\Cart;
use App\Models\Order;
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

                if ( $check->color !== $color || $check->size !== $size || $check->quantity !== $quantity ) {
                    $addCartData = new Cart();

                    $addCartData->user_id = $user_id;
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
                'message' => "Update your Cart",
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

    public function orderPlace( $request ) {

        $user_id = $request->user_id;
        $invoice_no = ( rand( 10009870, 100000 ) );
        $total_price = $request->total_price;
        $payment_method = $request->payment_method ? $request->payment_method : "Cash on Delivery";
        $payment_status = $request->payment_status ? $request->payment_status : 0;
        $payment_trx = $request->payment_trx;
        $order_status = 1;
        $note = $request->note;

        date_default_timezone_set( "Asia/Dhaka" );
        $order_date = date( "d-m-Y" );
        $order_time = date( "h:i:sa" );

        $cartData = Cart::where( 'user_id', $user_id )->get();

        //Retrive Data from cart and convert array
        $productIdArray = [];
        $quantityArray = [];
        $colorArray = [];
        $sizeArray = [];
        $actualPriceArray = [];
        $discountPriceArray = [];
        foreach ( $cartData as $data ) {
            $productIdArray[] = $data->product_id;
            $quantityArray[] = $data->quantity;
            $colorArray[] = $data->color;
            $sizeArray[] = $data->size;
            $actualPriceArray[] = $data->actual_price;
            $discountPriceArray[] = $data->discount_price;
        }

        //Place Order
        $orderData = new Order();

        $orderData->invoice_no = $invoice_no;
        $orderData->user_id = $user_id;
        $orderData->product_id = json_encode( $productIdArray );
        $orderData->quantity = json_encode( $quantityArray );
        $orderData->color = json_encode( $colorArray );
        $orderData->size = json_encode( $sizeArray );
        $orderData->actual_price = json_encode( $actualPriceArray );
        $orderData->discount_price = json_encode( $discountPriceArray );
        $orderData->total_price = $total_price;
        $orderData->payment_method = $payment_method;
        $orderData->payment_status = $payment_status;
        $orderData->payment_trx = $payment_trx;
        $orderData->order_status = $order_status;
        $orderData->note = $note;
        $orderData->order_date = $order_date;
        $orderData->order_time = $order_time;

        $orderData->save();

        if ( $orderData ) {
            $cartDelete = Cart::where( 'user_id', $user_id )->delete();
        }

        return $orderData;
    }

}