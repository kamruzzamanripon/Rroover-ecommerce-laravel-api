<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BrandRepository;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller {
    public $BrandRepository;

    public function __construct( BrandRepository $BrandRepository ) {
        $this->BrandRepository = $BrandRepository;

        $this->middleware( 'permission:brand.access|brand.create|brand.update|brand.delete', ['only' => ['brandList']] );
        $this->middleware( 'permission:brand.create', ['only' => ['brandStore']] );
        $this->middleware( 'permission:brand.update', ['only' => ['brandUpdate']] );
        $this->middleware( 'permission:brand.delete', ['only' => ['destroyBrand']] );
    }

    public function brandList() {
        try {

            $brandData = $this->BrandRepository->brandList();

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

    public function singleBrandProducts( $id ) {
        try {

            $brandData = $this->BrandRepository->singleBrandProducts( $id );

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

    public function brandStore( BrandRequest $request ) {
        try {

            $brandData = $this->BrandRepository->brandStore( $request );

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

    public function brandUpdate( BrandRequest $request, $id ) {
        try {

            $brandData = $this->BrandRepository->brandUpdate( $request, $id );

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

    public function destroyBrand( $id ) {
        try {

            $brandData = $this->BrandRepository->destroyBrand( $id );

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
