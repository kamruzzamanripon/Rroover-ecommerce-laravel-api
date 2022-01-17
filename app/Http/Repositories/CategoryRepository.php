<?php

namespace App\Http\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\category;
use App\Models\product;
use App\Models\subcategory;

class CategoryRepository {

    public function categoryList() {

        $categoryListData = category::with( 'subcategory' )->get();

        $categoryListData = CategoryResource::collection( $categoryListData );
        return $categoryListData;
    }

    public function singleCategory( $id ) {

        $singleCategoryData = category::where( 'id', $id )->with( 'subcategory', 'products' )->first();

        return $singleCategoryData;
    }

    public function singleCategoryProducts( $request ) {
        $catId = $request->catId;
        $subCatId = $request->subCatId;
        $priceOrder = $request->priceOrder;
        $orderArrange = $priceOrder ? $priceOrder : 'desc';
        $bestRating = $request->bestRating;
        $bestSelling = $request->bestSelling;
        $showProduct = $request->showProduct;
        $paginate = $showProduct ? $showProduct : 5;

        $singleCategoryData = product::where( 'category_id', $catId )
            ->with( 'category', 'category.subcategory' )
            ->where( 'subcategorie_id', 'LIKE', '%' . $subCatId . '%' )
            ->where( 'actual_price', '>', 0 )
            ->where( 'top_rating', 'LIKE', '%' . $bestRating . '%' )
            ->where( 'best_selling', 'LIKE', '%' . $bestSelling . '%' )
        // ->when( $bestRating, function ( $query ) use ( $bestRating ) {
        //     $query->where( 'top_rating', 'LIKE', '%' . $bestRating . '%' );
        // } )
        // ->whereHas( $subCatId, function ( $query ) use ( $subCatId ) {
        //     if ( $subCatId ) {

        //         $query->where( 'subcategorie_id', $subCatId );
        //     }
        // } )
            ->orderBy( 'actual_price', $orderArrange )

            ->paginate( $paginate );
        //->get();

        //Total Product show
        $category = category::find( $catId );
        $TotalcategoryProduct = count( $category->products );
        $subCategory = subcategory::find( 19 );
        $totalSubcategoryProduct = count( $subCategory->products );

        return $singleCategoryData;
    }

    public function subcategoryProducts( $catid, $subid ) {

        $subcategoryProductsData = product::where( 'category_id', $catid )->where( 'subcategorie_id', $subid )->with( 'subcategory' )->get();

        return $subcategoryProductsData;
    }
}