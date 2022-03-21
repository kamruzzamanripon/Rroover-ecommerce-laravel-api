<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BrandRepository;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller {
    public $BrandRepository;

    public function __construct( BrandRepository $BrandRepository ) {
        $this->BrandRepository = $BrandRepository;

        // $this->middleware( 'permission:brand.access|brand.create|brand.update|brand.delete', ['only' => ['brandList']] );
        // $this->middleware( 'permission:brand.create', ['only' => ['brandStore']] );
        // $this->middleware( 'permission:brand.update', ['only' => ['brandUpdate']] );
        // $this->middleware( 'permission:brand.delete', ['only' => ['destroyBrand']] );
    }

    //All Brand List With Pagination
    public function brandList() {
        try {

            $brandData = $this->BrandRepository->brandListWithPagination();

            return response()->json( [
                'success' => true,
                'message' => 'Brand Data All with Pagination',
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

    //All Brand List WithOut Pagination
    public function brandListWithOutPagination() {
        try {

            $brandData = $this->BrandRepository->brandList();

            return response()->json( [
                'success' => true,
                'message' => 'Brand Data All withOut Pagination',
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

    // //Single Brand Item by ID
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

    // Brand Item Store/ Add
    public function brandStore( BrandRequest $request ) {
        try {

            $brandData = $this->BrandRepository->brandStore( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Brand Data Add',
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

    //Brand Item Update/Edit
    public function brandUpdate( BrandRequest $request, $id ) {
        try {

            $brandData = $this->BrandRepository->brandUpdate( $request, $id );

            return response()->json( [
                'success' => true,
                'message' => 'Brand Data Edit',
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

    //Brand Item destroy/ Delete
    public function destroyBrand( $id ) {
        try {

            $brandData = $this->BrandRepository->destroyBrand( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Brand Data Delete',
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
