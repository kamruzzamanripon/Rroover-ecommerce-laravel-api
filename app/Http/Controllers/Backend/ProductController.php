<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller {

    public $ProductRepository;

    public function __construct( ProductRepository $ProductRepository ) {
        $this->ProductRepository = $ProductRepository;
    }

    public function allProduct() {
        try {

            $allProductData = $this->ProductRepository->productAll();

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $allProductData,
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

    public function singleProduct( $id ) {
        try {

            $singleProductData = $this->ProductRepository->singleProduct( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $singleProductData,
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

    public function storeProduct( ProductRequest $request ) {
       
        try {

            $singleProductData = $this->ProductRepository->storeProduct( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $singleProductData,
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

    public function singleProductUpdate (ProductRequest $request, $id){

        try {

            $singleProductData = $this->ProductRepository->singleProductUpdate( $request, $id );

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $singleProductData,
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

    public function singleProductDestory($id){
        try {

            $singleProductData = $this->ProductRepository->singleProductDestory( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $singleProductData,
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
}
