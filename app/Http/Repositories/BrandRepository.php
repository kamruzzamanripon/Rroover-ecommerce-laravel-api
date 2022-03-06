<?php

namespace App\Http\Repositories;

use App\Models\band;
use App\Models\product;
use Carbon\Carbon;

class BrandRepository {

    public function brandList() {

        $brandData = band::all();

        return $brandData;
    }

    public function singleBrandProducts( $id ) {

        $singleBrandProductData = product::where( 'brand_id', $id )->with( 'brand' )->get();

        return $singleBrandProductData;
    }

    public function brandStore( $request ) {

        if ( $request->hasfile( 'image' ) ) {
            $destination_path = 'public/image/brand';
            //$name=$file->getClientOriginalName();
            $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->file( 'image' )->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $name );
            $image = 'storage/image/brand/' . $name;
        }

        $brand = new band();

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $request->file( 'image' ) ? $image : '';
        $brand->save();

        return $brand;
    }

    public function brandUpdate( $request, $id ) {

        $brandUpdate = band::findOrFail( $id );

        if ( $request->hasFile( 'image' ) ) {

            if ( $brandUpdate->image ) {
                unlink( $brandUpdate->image );
            }

            $destination_path = 'public/image/brand';
            $image = $request->file( 'image' );
            $image_name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->image->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $image_name );
        }

        $brandUpdate->name = $request->name ? $request->name : $brandUpdate->name;
        $brandUpdate->description = $request->description ? $request->description : $brandUpdate->description;
        $brandUpdate->image = $request->file( 'image' ) ? 'storage/image/brand/' . $image_name : $brandUpdate->image;
        $brandUpdate->save();

        return $brandUpdate;
    }

    public function destroyBrand( $id ) {

        $brandDelete = band::where( 'id', $id )->first();
        $image = $brandDelete->image;
        if ( $image ) {
            unlink( $image );
        }

        $brandDelete->delete();

        return $brandDelete;
    }
}