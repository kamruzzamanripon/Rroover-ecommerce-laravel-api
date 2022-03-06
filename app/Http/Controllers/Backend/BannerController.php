<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BannerRepository;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller {
    public $BannerRepository;

    public function __construct( BannerRepository $BannerRepository ) {
        $this->BannerRepository = $BannerRepository;
    }

    public function bannerAll() {
        try {

            $brandData = $this->BannerRepository->bannerAll();

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $brandData,
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

    public function bannerSingleById($id){
        try {

            $brandData = $this->BannerRepository->bannerSingleById($id);

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $brandData,
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

    public function bannerStore(BannerRequest $request){
        try {

            $brandData = $this->BannerRepository->bannerStore($request);

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $brandData,
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

    public function updateBannerSingleById(BannerRequest $request, $id){
        try {

            $brandData = $this->BannerRepository->updateBannerSingleById($request, $id);

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $brandData,
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

    public function deleteBannerSingleById($id){
        try {

            $brandData = $this->BannerRepository->deleteBannerSingleById($id);

            return response()->json( [
                'success' => true,
                'message' => 'Product Data',
                'data'    => $brandData,
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
