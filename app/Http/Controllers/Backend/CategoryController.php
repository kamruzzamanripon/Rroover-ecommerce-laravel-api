<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller {

    public $CategoryRepository;

    public function __construct( CategoryRepository $CategoryRepository ) {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function index() {
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


    public function store(CategoryRequest $request) {
        try {

            $categoryData = $this->CategoryRepository->addCategory( $request);

            return response()->json( [
                'success' => true,
                'message' => 'Category Data',
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


    public function update(CategoryRequest $request , $id ) {
        try {

            $categoryData = $this->CategoryRepository->updateCategory( $request, $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data',
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

    public function destroy($id) {
        try {

            $categoryData = $this->CategoryRepository->deleteCategory( $id );

            return response()->json( [
                'success' => true,
                'message' => 'Category Data',
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
}
