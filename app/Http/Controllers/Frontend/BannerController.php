<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BannerRepository;

class BannerController extends Controller {
    public $BannerRepository;

    public function __construct( BannerRepository $BannerRepository ) {
        $this->BannerRepository = $BannerRepository;
    }

    public function index() {
        try {
            $bannerData = $this->BannerRepository->showAll();

            return response()->json( [
                'success' => true,
                'message' => 'Banner Random data',
                'data'    => $bannerData,
            ], 200 );

        } catch ( \Exception $e ) {
            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 200 );
        }
    }

    public function singleBanner() {
        try {
            $singleBannerData = $this->BannerRepository->singleBanner();

            return response()->json( [
                'success' => true,
                'message' => 'Banner Random data',
                'data'    => $singleBannerData,
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();

            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 200 );
        }
    }

}
