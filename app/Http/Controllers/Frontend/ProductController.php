<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;

class ProductController extends Controller {
    public $ProductRepository;

    public function __construct( ProductRepository $ProductRepository ) {
        $this->ProductRepository = $ProductRepository;
    }

    public function mensLatestPeoduct( $query ) {

        try {

            $mensLatestPeoductData = $this->ProductRepository->mensLatestPeoduct( $query );

            return response()->json( [
                'success' => true,
                'message' => 'Mens Product Data list',
                'data'    => $mensLatestPeoductData['data'],
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

    public function mensHotDeals() {

        try {
            $mensHotDealsData = $this->ProductRepository->mensHotDeals();

            return response()->json( [
                'success' => true,
                'message' => 'Mens hot product data list',
                'data'    => $mensHotDealsData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function womensLatestPeoduct( $query ) {

        try {

            $womensLatestPeoductData = $this->ProductRepository->womensLatestPeoduct( $query );
            return response()->json( [
                'success' => true,
                'message' => 'womens product data list',
                'data'    => $womensLatestPeoductData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function toysLatestPeoduct( $query ) {
        try {

            $toysLatestPeoductData = $this->ProductRepository->toysLatestPeoduct( $query );
            return response()->json( [
                'success' => true,
                'message' => 'Toys product data list',
                'data'    => $toysLatestPeoductData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function mobileTabletPeoduct( $query ) {
        try {

            $mobileTabletPeoductData = $this->ProductRepository->mobileTabletPeoduct( $query );
            return response()->json( [
                'success' => true,
                'message' => 'Toys product data list',
                'data'    => $mobileTabletPeoductData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function bookAudiablePeoduct( $query ) {
        try {

            $bookAudiablePeoductData = $this->ProductRepository->bookAudiablePeoduct( $query );
            return response()->json( [
                'success' => true,
                'message' => 'Book and Audio data list',
                'data'    => $bookAudiablePeoductData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function beautyHealthPeoduct( $query ) {
        try {

            $beautyHealthPeoductData = $this->ProductRepository->beautyHealthPeoduct( $query );
            return response()->json( [
                'success' => true,
                'message' => 'Beauty and Health data list',
                'data'    => $beautyHealthPeoductData['data'],
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function singleProduct( $id ) {

        try {

            $singleProductData = $this->ProductRepository->singleProduct( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Single Product Information',
                'data'    => $singleProductData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function newArrivals() {

        try {

            $newArrivalsData = $this->ProductRepository->newArrivals();

            return response()->json( [
                'success' => true,
                'message' => 'New Arrivals Product Information',
                'data'    => $newArrivalsData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }

    }

    public function exclusiveDeals() {
        try {

            $exclusiveDealsData = $this->ProductRepository->exclusiveDeals();

            return response()->json( [
                'success' => true,
                'message' => 'Exclusive Deals Product Information',
                'data'    => $exclusiveDealsData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function flashDeals() {
        try {

            $flashDealsData = $this->ProductRepository->flashDeals();

            return response()->json( [
                'success' => true,
                'message' => 'flash Deals Data Product Information',
                'data'    => $flashDealsData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

    public function superSales() {
        try {

            $superSalesData = $this->ProductRepository->superSales();

            return response()->json( [
                'success' => true,
                'message' => 'super Sales Product Information',
                'data'    => $superSalesData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 205 );
        }
    }

}
