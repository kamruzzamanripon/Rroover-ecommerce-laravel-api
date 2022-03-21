<?php

namespace App\Http\Repositories;

use App\Http\Resources\BannerResource;
use App\Models\banner;
use Carbon\Carbon;

class BannerRepository {

    public function showAll() {
        $bannerData = banner::all()->random( 5 );

        $bannerDataAll = BannerResource::collection( $bannerData );
        return $bannerDataAll;
    }

    public function bannerAll() {
        $bannerData = banner::get();

        $bannerDataAll = BannerResource::collection( $bannerData );
        return $bannerDataAll;
    }

    public function bannerAllWithPagination() {
        $bannerData = banner::orderBy( 'id', 'desc' )->paginate( 5 );

        $bannerDataAll = BannerResource::collection( $bannerData )->response()->getData( true );
        return $bannerDataAll;
    }

    public function singleBanner() {

        $singleBannerData = banner::all()->random( 1 );

        return $singleBannerData;
    }

    public function bannerSingleById( $id ) {

        $singleBannerData = banner::where( 'id', $id )->first();

        $singleBannerResources = new BannerResource( $singleBannerData );
        return $singleBannerResources;
    }

    public function bannerStore( $request ) {

        if ( $request->hasfile( 'image' ) ) {
            $destination_path = 'public/image/banner';
            //$name=$file->getClientOriginalName();
            $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->file( 'image' )->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $name );
            $image = 'storage/image/banner/' . $name;
        }

        $banner = new banner();

        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->image = $request->file( 'image' ) ? $image : '';
        $banner->save();

        $bannerResources = new BannerResource( $banner );
        return $bannerResources;
    }

    public function updateBannerSingleById( $request, $id ) {

        $bannerUpdate = banner::findOrFail( $id );

        if ( $request->hasFile( 'image' ) ) {

            if ( $bannerUpdate->image ) {
                unlink( $bannerUpdate->image );
            }

            $destination_path = 'public/image/banner';
            $image = $request->file( 'image' );
            $image_name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->image->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $image_name );
            $image = 'storage/image/banner/' . $image_name;
        }

        $bannerUpdate->title = $request->title ? $request->title : $bannerUpdate->title;
        $bannerUpdate->sub_title = $request->sub_title ? $request->sub_title : $bannerUpdate->sub_title;
        $bannerUpdate->image = $request->file( 'image' ) ? $image : $bannerUpdate->image;
        $bannerUpdate->save();

        $bannerResources = new BannerResource( $bannerUpdate );
        return $bannerResources;
    }

    public function deleteBannerSingleById( $id ) {

        $bannerDelete = banner::where( 'id', $id )->first();
        $image = $bannerDelete->image;
        if ( $image ) {
            unlink( $image );
        }

        $bannerDelete->delete();

        return $bannerDelete;
    }
}