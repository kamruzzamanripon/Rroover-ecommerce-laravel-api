<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SubcategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public $CategoryRepository;

    public function __construct( CategoryRepository $CategoryRepository ) {
        $this->CategoryRepository = $CategoryRepository;

        //Subcategory Permissions
        // $this->middleware( 'permission:subcategory.access|subcategory.create|subcategory.update|subcategory.delete', ['only' => ['indexSubcategory']] );
        // $this->middleware( 'permission:subcategory.create', ['only' => ['storeSubcategory']] );
        // $this->middleware( 'permission:subcategory.update', ['only' => ['updateSubcategory']] );
        // $this->middleware( 'permission:subcategory.delete', ['only' => ['destroySubcategory']] );
    }

    //All Category Show with pagination
    public function index() {
        try {

            $categoryListData = $this->CategoryRepository->backendCategoryList();

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

    //All Category Show without pagination
    public function listWithourPagination() {
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

    //Single Category show by Id and also show catId related sub-category and producst
    public function singleCategorybyId( $id ) {
        try {

            $categorySingleData = $this->CategoryRepository->singleCategory( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Single Data by Id',
                'data'    => $categorySingleData,
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

    //Category Store/add
    public function store( Request $request ) {
        //Data Validation
        $formData = $request->all();
        $validator = \Validator::make( $formData, [
            'name' => 'required|string|unique:categories',
        ], [
            'name.required' => 'Please give name',
        ] );
        if ( $validator->fails() ) {
            return response()->json( [
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors'  => $validator->getMessageBag(),
            ] );
        }

        try {

            $categoryData = $this->CategoryRepository->addCategory( $request );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data Add',
                'data'    => $categoryData,
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

    //category update/Edit
    public function update( CategoryRequest $request, $id ) {
        //Data Validation
        $formData = $request->all();
        $validator = \Validator::make( $formData, [
            'name' => 'required|string|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Please give name',
        ] );
        if ( $validator->fails() ) {
            return response()->json( [
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors'  => $validator->getMessageBag(),
            ] );
        }

        try {

            $categoryData = $this->CategoryRepository->updateCategory( $request, $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data Edit',
                'data'    => $categoryData,
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

    //category Destroy/Delete
    public function destroy( $id ) {
        try {

            $categoryData = $this->CategoryRepository->deleteCategory( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data Delete',
                'data'    => $categoryData,
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

    //SubCategory all with Pagination
    public function indexSubcategoryWithPagination() {
        try {

            $subCategoryData = $this->CategoryRepository->indexSubcategoryWithPagination();

            return response()->json( [
                'success' => true,
                'message' => 'sub-Category AllData',
                'data'    => $subCategoryData,
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

    //SubCategory Store/add
    public function storeSubcategory( Request $request ) {
        //Data Validation
        $formData = $request->all();
        $validator = \Validator::make( $formData, [
            'name' => 'required|string|unique:subcategories',
        ], [
            'name.required' => 'Please give name',
        ] );
        if ( $validator->fails() ) {
            return response()->json( [
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors'  => $validator->getMessageBag(),
            ] );
        }

        try {

            $subCategoryData = $this->CategoryRepository->subcategoryStore( $request );

            return response()->json( [
                'success' => true,
                'message' => 'sub-Category Data Add',
                'data'    => $subCategoryData,
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

    //Subcategory uddate/Edit
    public function updateSubcategory( SubcategoryRequest $request, $id ) {
        //Data Validation
        $formData = $request->all();
        $validator = \Validator::make( $formData, [
            'name' => 'required|string|unique:subcategories,name,' . $id,
        ], [
            'name.required' => 'Please give name',
        ] );
        if ( $validator->fails() ) {
            return response()->json( [
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors'  => $validator->getMessageBag(),
            ] );
        }

        try {

            $subCategoryData = $this->CategoryRepository->subcategoryUpdate( $request, $id );

            return response()->json( [
                'success' => true,
                'message' => 'sub-Category Data Update',
                'data'    => $subCategoryData,
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

    //Subcategory Destory/Delete
    public function destroySubcategory( $id ) {
        try {

            $subCategoryData = $this->CategoryRepository->subcategoryDestroy( $id );

            return response()->json( [
                'success' => true,
                'message' => 'sub-Category Data Delete',
                'data'    => $subCategoryData,
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
