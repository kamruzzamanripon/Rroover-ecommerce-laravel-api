<?php

namespace App\Http\Repositories;

use App\Models\band;
use App\Models\product;

class BrandRepository {

    public function brandList() {

        $brandListData = band::all();

        return $brandListData;
    }

    public function singleBrandProducts( $id ) {

        $singleBrandProductData = product::where( 'brand_id', $id )->with( 'brand' )->get();

        return $singleBrandProductData;
    }
}