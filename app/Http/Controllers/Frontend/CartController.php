<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserInformationRequest;
use Illuminate\Http\Request;

class CartController extends Controller {
    public $CartRepository;
    public $UserRepository;

    public function __construct( CartRepository $CartRepository, UserRepository $UserRepository ) {
        $this->CartRepository = $CartRepository;
        $this->UserRepository = $UserRepository;
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

    public function deleteCart( $productId ) {

        $deleteCartData = $this->CartRepository->deleteCart( $productId );

        return response()->json( [
            'success' => true,
            'message' => 'Delete Cart Information',
            'data'    => $deleteCartData,
        ], 200 );
    }

    public function userInfo( $userId ) {

        $userInfoData = $this->UserRepository->userInfo( $userId );

        return response()->json( [
            'success' => true,
            'message' => 'User Information',
            'data'    => $userInfoData,
        ], 200 );
    }

    public function userInfoCheck( UserInformationRequest $request ) {

        try {

            $userInfoCheckData = $this->UserRepository->userInfoCheck( $request );

            return response()->json( [
                'success' => true,
                'message' => 'User Information',
                'data'    => $userInfoCheckData,
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

    public function alterShippingInfo( Request $request ) {
        try {

            $alterShippingInfoData = $this->UserRepository->alterShippingInfo( $request );

            return response()->json( [
                'success' => true,
                'message' => 'alter ShippingInfo Data Information',
                'data'    => $alterShippingInfoData,
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

    public function orderPlace( Request $request ) {
        //return dd( $request->user_id );
        $orderPlaceData = $this->CartRepository->orderPlace( $request );

        return response()->json( [
            'success' => true,
            'message' => 'Order Information',
            'data'    => $orderPlaceData,
        ], 200 );
    }

}
