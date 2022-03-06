<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

//http://localhost:8000/api/v1/backend/

Route::post( 'user-login', [UserController::class, 'login'] );

Route::group( ['middleware' => ['auth:admin', 'scopes:admin']], function () {

    // Route::get( 'test', function () { return "hello Ripon, how are youxxx"; } );
    Route::post( 'user-logout', [UserController::class, 'logOut'] );

    Route::get( 'category', [CategoryController::class, 'index'] );
    Route::post( 'category/add', [CategoryController::class, 'store'] );
    Route::post( 'category/{id}', [CategoryController::class, 'update'] );
    Route::delete( 'category/{id}', [CategoryController::class, 'destroy'] );

    Route::get( 'sub-category', [CategoryController::class, 'indexSubcategory'] );
    Route::post( 'sub-category/add', [CategoryController::class, 'storeSubcategory'] );
    Route::post( 'sub-category/{id}', [CategoryController::class, 'updateSubcategory'] );
    Route::delete( 'sub-category/{id}', [CategoryController::class, 'destroySubcategory'] );

    Route::get( 'product/all', [ProductController::class, 'allProduct'] );
    Route::post( 'product/store', [ProductController::class, 'storeProduct'] );
    Route::get( 'product/single/{id}', [ProductController::class, 'singleProduct'] );
    Route::put( 'product/single/{id}', [ProductController::class, 'singleProductUpdate'] );
    Route::delete( 'product/single/{id}', [ProductController::class, 'singleProductDestory'] );

    Route::get( 'brand/all', [BrandController::class, 'brandList'] );
    Route::post( 'brand/store', [BrandController::class, 'brandStore'] );
    Route::post( 'brand/edit/{id}', [BrandController::class, 'brandUpdate'] );
    Route::get( 'brand/single/{id}', [BrandController::class, 'singleBrandProducts'] );
    Route::delete( 'brand/delete/{id}', [BrandController::class, 'destroyBrand'] );
} );

Route::get( 'banner/all', [BannerController::class, 'bannerAll'] );
Route::post( 'banner/store', [BannerController::class, 'bannerStore'] );
Route::get( 'banner/single/{id}', [BannerController::class, 'bannerSingleById'] );
Route::post( 'banner/single/{id}', [BannerController::class, 'updateBannerSingleById'] );
Route::delete( 'banner/single/{id}', [BannerController::class, 'deleteBannerSingleById'] );