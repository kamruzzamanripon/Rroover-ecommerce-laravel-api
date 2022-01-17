<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\product;

class ProductRepository {

    public function mensLatestPeoduct( $query ) {

        $category = 'Men\'s clothing';

        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $mensLatestPeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $mensLatestPeoductData = ProductResource::collection( $mensLatestPeoductData )->response()->getData( true );

        } else {

            $mensLatestPeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $mensLatestPeoductData = ProductResource::collection( $mensLatestPeoductData )->response()->getData( true );
        }

        return $mensLatestPeoductData;

    }

    public function mensHotDeals() {

        $mensHotDealsData = product::where( 'hot', '=', '1' )->get()->random( 4 );

        $mensHotDealsData = ProductResource::collection( $mensHotDealsData )->response()->getData( true );

        return $mensHotDealsData;
    }

    public function womensLatestPeoduct( $query ) {

        $category = 'Woments\'s clothing';
        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $womensLatestPeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $womensLatestPeoductData = ProductResource::collection( $womensLatestPeoductData )->response()->getData( true );

        } else {

            $womensLatestPeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $womensLatestPeoductData = ProductResource::collection( $womensLatestPeoductData )->response()->getData( true );
        }

        return $womensLatestPeoductData;
    }

    public function toysLatestPeoduct( $query ) {

        $category = 'Toys Hobbies & Robot';
        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $toysLatestPeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $toysLatestPeoductData = ProductResource::collection( $toysLatestPeoductData )->response()->getData( true );

        } else {

            $toysLatestPeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $toysLatestPeoductData = ProductResource::collection( $toysLatestPeoductData )->response()->getData( true );
        }

        return $toysLatestPeoductData;
    }

    public function mobileTabletPeoduct( $query ) {

        $category = 'Toys Hobbies & Robot';
        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $mobileTabletPeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $mobileTabletPeoductData = ProductResource::collection( $mobileTabletPeoductData )->response()->getData( true );

        } else {

            $mobileTabletPeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $mobileTabletPeoductData = ProductResource::collection( $mobileTabletPeoductData )->response()->getData( true );
        }

        return $mobileTabletPeoductData;
    }

    public function bookAudiablePeoduct( $query ) {

        $category = 'Books & Audible';
        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $bookAudiablePeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $bookAudiablePeoductData = ProductResource::collection( $bookAudiablePeoductData )->response()->getData( true );

        } else {

            $bookAudiablePeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $bookAudiablePeoductData = ProductResource::collection( $bookAudiablePeoductData )->response()->getData( true );
        }

        return $bookAudiablePeoductData;
    }

    public function beautyHealthPeoduct( $query ) {

        $category = 'Beauty & Helath';
        if ( $query === 'best_selling' | $query === 'top_rating' | $query === 'featured' ) {

            $beautyHealthPeoductData = product::where( $query, '=', '1' )
                ->with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $beautyHealthPeoductData = ProductResource::collection( $beautyHealthPeoductData )->response()->getData( true );

        } else {

            $beautyHealthPeoductData = product::with( 'category', 'subcategory', 'brand' )
                ->whereHas( 'category', function ( $q ) use ( $category ) {
                    $q->where( 'name', '=', $category );
                } )
                ->orderBy( 'name', 'desc' )
                ->limit( 15 )
                ->get();

            $beautyHealthPeoductData = ProductResource::collection( $beautyHealthPeoductData )->response()->getData( true );
        }

        return $beautyHealthPeoductData;
    }

    public function singleProduct( $id ) {

        $singleProductData = product::where( 'id', $id )->first();
        $singleProductData = new ProductResource( $singleProductData );

        return $singleProductData;
    }

    public function newArrivals() {

        $newArrivalsData = product::where( 'featured', "1" )->get();

        return $newArrivalsData;
    }

    public function exclusiveDeals() {

        $exclusiveDealsData = product::where( 'hot', "1" )->get();

        return $exclusiveDealsData;
    }

    public function flashDeals() {

        $flashDealsData = product::where( 'sale', "1" )->get();

        return $flashDealsData;
    }

    public function superSales() {

        $superSalesData = product::where( 'best_selling', "1" )->get();

        return $superSalesData;
    }

}
