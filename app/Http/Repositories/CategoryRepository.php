<?php

namespace App\Http\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use Carbon\Carbon;

class CategoryRepository {

    public function categoryList() {

        $categoryListData = category::with( 'subcategory' )->get();

        $categoryListData = CategoryResource::collection( $categoryListData );

        return $categoryListData;
    }

    public function backendCategoryList() {

        $categoryListData = category::with( 'subcategory' )->orderBy( 'id', 'desc' )->paginate( 3 );

        $categoryListData = CategoryResource::collection( $categoryListData )->response()->getData( true );

        return $categoryListData;
    }


    //Single Category show by Id and also show catId related sub-category and producst    
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

    public function addCategory( $request ) {

        if ( $request->hasfile( 'image' ) ) {$destination_path = 'public/image/category';
            //$name=$file->getClientOriginalName();
            $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->file( 'image' )->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $name );
            $image = 'storage/image/category/' . $name;
        }

        $newCategory = new category();

        $newCategory->name = $request->name;
        $newCategory->description = $request->description;
        $newCategory->image = $request->file( 'image' ) ? $image : '';
        $newCategory->save();

        $categoryData = new CategoryResource( $newCategory );
        return $categoryData;
    }

    public function updateCategory( $request, $id ) {

        $categoryupdate = category::findOrFail( $id );

        if ( $request->hasFile( 'image' ) ) {

            if ( $categoryupdate->image ) {
                unlink( $categoryupdate->image );
            }

            $destination_path = 'public/image/category';
            $image = $request->file( 'image' );
            $image_name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->image->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $image_name );
        }

        $categoryupdate->name = $request->name ?? $request->name;
        $categoryupdate->description = $request->description ? $request->description : $categoryupdate->description;
        $categoryupdate->image = $request->file( 'image' ) ? 'storage/image/category/' . $image_name : $categoryupdate->image;
        $categoryupdate->save();

        $categoryData = new CategoryResource( $categoryupdate );
        return $categoryData;
    }

    public function deleteCategory( $id ) {
        $categoryDelete = category::where( 'id', $id )->first();
        $image = $categoryDelete->image;
        if ( $image ) {
            unlink( $image );
        }

        $categoryDelete->delete();

        return $categoryDelete;
    }

    //Sub Category Function Start
    public function subcategoryIndex() {
        $subCategoryListData = subcategory::with( 'category' )->get();

        $categoryListData = SubcategoryResource::collection( $subCategoryListData );
        return $categoryListData;
    }

    public function indexSubcategoryWithPagination() {
        $subCategoryListData = subcategory::with( 'category' )->orderBy( 'id', 'desc' )->paginate( 5 );

        $categoryListData = SubcategoryResource::collection( $subCategoryListData )->response()->getData( true );
        return $categoryListData;
    }

    public function subcategoryStore( $request ) {

        if ( $request->hasfile( 'image' ) ) {$destination_path = 'public/image/sub-category';
            //$name=$file->getClientOriginalName();
            $name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->file( 'image' )->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $name );
            $image = 'storage/image/sub-category/' . $name;
        }

        $subCategory = new subcategory();

        $subCategory->name = $request->name;
        $subCategory->description = $request->description;
        $subCategory->image = $request->file( 'image' ) ? $image : '';
        $subCategory->category_id = $request->category_id;
        $subCategory->save();

        $subCategoryData = new SubcategoryResource( $subCategory );
        return $subCategoryData;
    }

    public function subcategoryUpdate( $request, $id ) {

        $subCategoryupdate = subcategory::findOrFail( $id );

        if ( $request->hasFile( 'image' ) ) {

            if ( $subCategoryupdate->image ) {
                unlink( $subCategoryupdate->image );
            }

            $destination_path = 'public/image/sub-category';
            $image = $request->file( 'image' );
            $image_name = Carbon::now()->toDateString() . "_" . rand( 666561, 544614449 ) . "_." . $request->image->getClientOriginalExtension();
            $path = $request->file( 'image' )->storeAs( $destination_path, $image_name );
        }

        $subCategoryupdate->name = $request->name ?? $request->name;
        $subCategoryupdate->description = $request->description ? $request->description : $subCategoryupdate->description;
        $subCategoryupdate->image = $request->file( 'image' ) ? 'storage/image/sub-category/' . $image_name : $subCategoryupdate->image;
        $subCategoryupdate->save();

        $subCategoryData = new SubcategoryResource( $subCategoryupdate );
        return $subCategoryData;
    }

    public function subcategoryDestroy( $id ) {

        $subCategoryDelete = subcategory::where( 'id', $id )->first();
        $image = $subCategoryDelete->image;
        if ( $image ) {
            unlink( $image );
        }

        $subCategoryDelete->delete();

        return $subCategoryDelete;
    }

}