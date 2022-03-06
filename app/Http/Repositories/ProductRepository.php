<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\product;
use Carbon\Carbon;

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

    public function productAll() {

        $productAll = product::with( 'category', 'subcategory', 'brand' )->get();

        $productAllData = ProductResource::collection( $productAll );
        return $productAllData;

    }

    public function singleProduct( $id ) {

        $singleProductData = product::where( 'id', $id )->first();
        $singleProductData = new ProductResource( $singleProductData );

        return $singleProductData;
    }

    public function storeProduct( $request ) {

        $data = [];
        if ( $request->hasfile( 'image' ) ) {

            $destination_path = 'public/image/products';
            //$name=$file->getClientOriginalName();
            foreach ( $request->file( 'image' ) as $file ) {

                $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $file->getClientOriginalExtension();
                $path = $file->storeAs( $destination_path, $name );
                $data[] = 'storage/image/products/' . $name;
            }
        }

        //convert [comma seperate]size date into array
        $commaSeperateSize = $request->size;
        $arrayConvertSize = explode( ',', $commaSeperateSize );

        //convert [comma seperate]color date into array
        $commaSeperateColors = $request->color;
        $arrayConvertColors = explode( ',', $commaSeperateColors );

        $newProduct = new product();

        $newProduct->category_id = $request->category_id;
        $newProduct->brand_id = $request->brand_id;
        $newProduct->subcategorie_id = $request->subcategorie_id;
        $newProduct->name = $request->name;
        $newProduct->product_code = rand( 5466545, 1656556 );
        $newProduct->quantity = $request->quantity;
        $newProduct->details = $request->details;
        $newProduct->color = json_encode( $arrayConvertColors );
        $newProduct->size = json_encode( $arrayConvertSize );
        $newProduct->actual_price = $request->actual_price;
        $newProduct->discount_price = $request->discount_price;
        $newProduct->video_link = $request->video_link;
        $newProduct->best_selling = $request->best_selling ? $request->best_selling : 0;
        $newProduct->top_rating = $request->top_rating ? $request->top_rating : 0;
        $newProduct->featured = $request->featured ? $request->featured : 0;
        $newProduct->hot = $request->hot ? $request->hot : 0;
        $newProduct->sale = $request->sale ? $request->sale : 0;
        $newProduct->status = $request->status ? $request->status : 0;
        $newProduct->image = $request->file( 'image' ) ? json_encode( $data ) : '';
        $newProduct->save();

        $newProductData = new ProductResource( $newProduct );
        return $newProductData;
    }

    public function singleProductUpdate( $request, $id ) {

        $productUpdate = product::findOrFail( $id );

        $data = [];
        if ( $request->hasfile( 'image' ) ) {

            if ( $productUpdate->image ) {
                $oldImages = json_decode( $productUpdate->image );
                foreach ( $oldImages as $oldImage ) {
                    unlink( $oldImage );
                }
            }

            $destination_path = 'public/image/products';
            //$name=$file->getClientOriginalName();
            foreach ( $request->file( 'image' ) as $file ) {

                $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $file->getClientOriginalExtension();
                $path = $file->storeAs( $destination_path, $name );
                $data[] = 'storage/image/products/' . $name;
            }
        }

        //convert [comma seperate]size date into array
        $commaSeperateSize = $request->size;
        $arrayConvertSize = explode( ',', $commaSeperateSize );

        //convert [comma seperate]color date into array

        $commaSeperateColors = $request->color;
        $arrayConvertColors = explode( ',', $commaSeperateColors );

        //return dd( $arrayConvertColors );

        $productUpdate->category_id = $request->category_id ? $request->category_id : $productUpdate->category_id;
        $productUpdate->brand_id = $request->brand_id ? $request->brand_id : $productUpdate->brand_id;
        $productUpdate->subcategorie_id = $request->subcategorie_id ? $request->subcategorie_id : $productUpdate->subcategorie_id;
        $productUpdate->name = $request->name ? $request->name : $productUpdate->name;
        $productUpdate->quantity = $request->quantity ? $request->quantity : $productUpdate->quantity;
        $productUpdate->details = $request->details ? $request->details : $productUpdate->details;
        $productUpdate->color = $request->color ? json_encode( $arrayConvertColors ) : $productUpdate->color;
        $productUpdate->size = $request->size ? json_encode( $arrayConvertSize ) : $productUpdate->size;
        $productUpdate->actual_price = $request->actual_price ? $request->actual_price : $productUpdate->actual_price;
        $productUpdate->discount_price = $request->discount_price ? $request->discount_price : $productUpdate->discount_price;
        $productUpdate->video_link = $request->video_link ? $request->video_link : $productUpdate->video_link;
        $productUpdate->best_selling = $request->best_selling ? $request->best_selling : 0;
        $productUpdate->top_rating = $request->top_rating ? $request->top_rating : 0;
        $productUpdate->featured = $request->featured ? $request->featured : 0;
        $productUpdate->hot = $request->hot ? $request->hot : 0;
        $productUpdate->sale = $request->sale ? $request->sale : 0;
        $productUpdate->status = $request->status ? $request->status : 0;
        $productUpdate->image = $request->file( 'image' ) ? json_encode( $data ) : $productUpdate->image;
        $productUpdate->save();

        $productUpdateData = new ProductResource( $productUpdate );
        return $productUpdateData;
    }

    public function singleProductDestory( $id ) {

        $productDelete = product::where( 'id', $id )->first();

        if ( $productDelete->image ) {
            $oldImages = json_decode( $productDelete->image );
            foreach ( $oldImages as $oldImage ) {
                unlink( $oldImage );
            }
        }

        $productDelete->delete();

        return $productDelete;
    }

}
