<?php

namespace App\Http\Repositories;

use App\Models\banner;

class BannerRepository {

    public function showAll() {
        $bannerData = banner::all()->random( 5 );

        return $bannerData;
    }

    public function singleBanner() {

        $singleBannerData = banner::all()->random( 1 );

        return $singleBannerData;
    }
}