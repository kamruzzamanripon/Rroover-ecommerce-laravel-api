<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller {
    public $CartRepository;

    public function __construct( CartRepository $CartRepository ) {
        $this->CartRepository = $CartRepository;
    }

    public function addCart( Request $request ) {

        try {

            $addCartData = $this->CartRepository->addCart( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Product Cart Information',
                'data'    => $addCartData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 203 );

        }
    }

    public function cartList() {

        try {

            $cartListData = $this->CartRepository->cartList();

            return response()->json( [
                'success' => true,
                'message' => 'Product Cart Information',
                'data'    => $cartListData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 203 );

        }
    }

    public function updateCart( Request $request ) {

        try {

            $updateCartData = $this->CartRepository->updateCart( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Product Cart Information',
                'data'    => $updateCartData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 203 );

        }

    }

    public function deleteCart($productId){

        $deleteCartData = $this->CartRepository->deleteCart($productId);

        return response()->json( [
            'success' => true,
            'message' => 'Delete Cart Information',
            'data'    => $deleteCartData,
        ], 200 );
    }

}
