<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PermissionsController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

//http://localhost:8000/api/v1/backend/

//Login Related Route
Route::post( 'login', [UserController::class, 'login'] );
Route::post( 'password/forgot-password', [UserController::class, 'forgotPassword'] );
Route::post( 'password/forgot-password/reset', [UserController::class, 'forgotPasswordReset'] );

Route::group( ['middleware' => ['auth:admin', 'scopes:admin']], function () {

    // Route::get( 'test', function () { return "hello Ripon, how are youxxx"; } );

    //Login Related Route
    Route::post( 'logout', [UserController::class, 'logOut'] );
    Route::post( 'register', [UserController::class, 'adminRegister'] );
    Route::post( 'password/password-change', [UserController::class, 'passwordChange'] );
    Route::get( 'user-list', [UserController::class, 'adminUserList'] );

    Route::get( 'category', [CategoryController::class, 'index'] );
    Route::get( 'category/list-without-pagination', [CategoryController::class, 'listWithourPagination'] );
    Route::post( 'category/add', [CategoryController::class, 'store'] );
    Route::post( 'category/{id}', [CategoryController::class, 'update'] );
    Route::get( 'category/{id}', [CategoryController::class, 'singleCategorybyId'] );
    Route::delete( 'category/{id}', [CategoryController::class, 'destroy'] );

    Route::get( 'sub-category', [CategoryController::class, 'indexSubcategoryWithPagination'] );
    Route::post( 'sub-category/add', [CategoryController::class, 'storeSubcategory'] );
    Route::post( 'sub-category/{id}', [CategoryController::class, 'updateSubcategory'] );
    Route::delete( 'sub-category/{id}', [CategoryController::class, 'destroySubcategory'] );

    Route::get( 'product/all', [ProductController::class, 'allProduct'] );
    Route::post( 'product/store', [ProductController::class, 'storeProduct'] );
    Route::get( 'product/single/{id}', [ProductController::class, 'singleProduct'] );
    Route::post( 'product/single/{id}', [ProductController::class, 'singleProductUpdate'] );
    Route::delete( 'product/single/{id}', [ProductController::class, 'singleProductDestory'] );

    Route::get( 'brand/all', [BrandController::class, 'brandList'] );
    Route::get( 'brand/allwithoutpagination', [BrandController::class, 'brandListWithOutPagination'] );
    Route::post( 'brand/store', [BrandController::class, 'brandStore'] );
    Route::post( 'brand/edit/{id}', [BrandController::class, 'brandUpdate'] );
    Route::get( 'brand/single/{id}', [BrandController::class, 'singleBrandProducts'] );
    Route::delete( 'brand/delete/{id}', [BrandController::class, 'destroyBrand'] );

    Route::get( 'banner/all', [BannerController::class, 'bannerAll'] );
    Route::post( 'banner/store', [BannerController::class, 'bannerStore'] );
    Route::get( 'banner/single/{id}', [BannerController::class, 'bannerSingleById'] );
    Route::post( 'banner/single/{id}', [BannerController::class, 'updateBannerSingleById'] );
    Route::delete( 'banner/single/{id}', [BannerController::class, 'deleteBannerSingleById'] );

    //role and permission
    Route::get( 'role/all', [RolePermissionController::class, 'roleAll'] );
    Route::get( 'role/all/pagination', [RolePermissionController::class, 'roleAllWithPagination'] );
    Route::get( 'role/single/{id}', [RolePermissionController::class, 'roleSingle'] );
    Route::post( 'role/create', [RolePermissionController::class, 'roleCreate'] );
    Route::post( 'role/update/{id}', [RolePermissionController::class, 'roleUpdate'] );
    Route::delete( 'role/delete/{id}', [RolePermissionController::class, 'roleDelete'] );
    Route::post( 'role/role-assign', [RolePermissionController::class, 'userRollAssign'] );
    //role and permission
    Route::get( 'permission/all', [PermissionsController::class, 'index'] );
    Route::get( 'permission/all/pagination', [PermissionsController::class, 'indexAllWithPagination'] );
    Route::post( 'permission/store', [PermissionsController::class, 'store'] );
    Route::post( 'permission/update/{id}', [PermissionsController::class, 'update'] );
    Route::delete( 'permission/delete/{id}', [PermissionsController::class, 'destroy'] );
    Route::post( 'permission/assign/{permissionId}', [PermissionsController::class, 'userPermissionAssign'] );

} );
