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

    public function addWishList( Request $request ) {
        //return response()->json( $request->user_id );
        try {

            $addWishListData = $this->CartRepository->addWishList( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Wishlist Respons Successfully',
                'data'    => $addWishListData,
            ], 200 );

        } catch ( \Exception $e ) {

            //throw new \Exception( 'url not correct ' );

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 203 );

        }

    }

    public function allWishList( Request $request ) {

        $allWishListData = $this->CartRepository->allWishList( $request );

        return response()->json( [
            'success' => true,
            'message' => 'Wishlist Respons Successfully',
            'data'    => $allWishListData,
        ], 200 );
    }
}
