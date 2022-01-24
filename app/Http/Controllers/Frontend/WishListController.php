<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\WishListRepository;
use Illuminate\Http\Request;

class WishListController extends Controller {
    public $WishListRepository;

    public function __construct( WishListRepository $WishListRepository ) {
        $this->WishListRepository = $WishListRepository;
    }

    public function addWishList( Request $request ) {
        //return response()->json( $request->user_id );
        try {

            $addWishListData = $this->WishListRepository->addWishList( $request );

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

    public function deleteWishProduct( $productId ) {

        $deleteWishProduct = $this->WishListRepository->deleteWishProduct( $productId );

        return response()->json( [
            'success' => true,
            'message' => 'Wish Product Delete Successfully',
            'data'    => $deleteWishProduct,
        ], 200 );
    }

    public function allWishList( Request $request ) {

        $allWishListData = $this->WishListRepository->allWishList( $request );

        return response()->json( [
            'success' => true,
            'message' => 'Wishlist Respons Successfully',
            'data'    => $allWishListData,
        ], 200 );
    }
}
