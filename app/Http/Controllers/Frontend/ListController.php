<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BrandRepository;
use App\Http\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class ListController extends Controller {
    public $CategoryRepository;
    public $BrandRepository;

    public function __construct( CategoryRepository $CategoryRepository, BrandRepository $BrandRepository ) {
        $this->CategoryRepository = $CategoryRepository;
        $this->BrandRepository = $BrandRepository;
    }

    public function categoryList() {

        try {

            $categoryListData = $this->CategoryRepository->categoryList();

            return response()->json( [
                'success' => true,
                'message' => 'Category Data list',
                'data'    => $categoryListData,
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

    public function brandList() {

        try {

            $brandListData = $this->BrandRepository->brandList();

            return response()->json( [
                'success' => true,
                'message' => 'Category Data list',
                'data'    => $brandListData,
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

    //Single Category show by Id and also show catId related sub-category and producst
    public function singleCategory( $id ) {

        try {

            $singleCategoryData = $this->CategoryRepository->singleCategory( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data',
                'data'    => $singleCategoryData,
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

    public function singleCategoryProducts( Request $request ) {
        //return dd( $request->catId );

        $singleCategoryProductsData = $this->CategoryRepository->singleCategoryProducts( $request );

        return response()->json( [
            'success' => true,
            'message' => 'Category Data',
            'data'    => $singleCategoryProductsData,
        ], 200 );

    }

    public function subcategoryProducts( $catid, $subid ) {

        try {

            $subcategoryProductsData = $this->CategoryRepository->subcategoryProducts( $catid, $subid );

            return response()->json( [
                'success' => true,
                'message' => 'subCategory-Data',
                'data'    => $subcategoryProductsData,
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

            $singleBrandProductData = $this->BrandRepository->singleBrandProducts( $id );

            return response()->json( [
                'success' => true,
                'message' => 'subCategory-Data',
                'data'    => $singleBrandProductData,
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
