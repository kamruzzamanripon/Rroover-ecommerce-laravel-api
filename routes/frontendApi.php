<?php

use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ListController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishListController;
use Illuminate\Support\Facades\Route;

//http://localhost:8000/api/v1/frontend/test

// Route::get( 'test', function () {
//     return "hello Ripon, how are youxxx";
// } );

//Home Page Url
Route::get( 'main-banner', [BannerController::class, 'index'] );
Route::get( 'single-banner', [BannerController::class, 'singleBanner'] );
Route::get( 'mens-latest-product/{query}', [ProductController::class, 'mensLatestPeoduct'] );
Route::get( 'mens-hotdeals', [ProductController::class, 'mensHotDeals'] );
Route::get( 'womens-latest-product/{query}', [ProductController::class, 'womensLatestPeoduct'] );
Route::get( 'toys-latest-product/{query}', [ProductController::class, 'toysLatestPeoduct'] );
Route::get( 'mobile-tablet/{query}', [ProductController::class, 'mobileTabletPeoduct'] );
Route::get( 'books-audiable/{query}', [ProductController::class, 'bookAudiablePeoduct'] );
Route::get( 'beauty-health/{query}', [ProductController::class, 'beautyHealthPeoduct'] );

//Single Product
Route::get( 'single-product/{id}', [ProductController::class, 'singleProduct'] );

//Category and Sub Category
Route::get( 'category-list', [ListController::class, 'categoryList'] );
Route::get( 'single-category/{id}', [ListController::class, 'singleCategory'] )->name( 'singleCategory' );
Route::get( 'single-category-products', [ListController::class, 'singleCategoryProducts'] );
Route::get( 'subcategory/{catid}/{subid}', [ListController::class, 'subcategoryProducts'] );

//Brand Product url
Route::get( 'brand-list', [ListController::class, 'brandList'] );
Route::get( 'single-brand/{brandid}', [ListController::class, 'singleBrandProducts'] );

//Menu Url[New Arrivals, Exclusive Deal, Flash Deal, Super Sale]
Route::get( 'new-arrivals', [ProductController::class, 'newArrivals'] );
Route::get( 'exclusive-deals', [ProductController::class, 'exclusiveDeals'] );
Route::get( 'flash-deals', [ProductController::class, 'flashDeals'] );
Route::get( 'super-sales', [ProductController::class, 'superSales'] );

// Login Related Route
Route::post( 'user-login', [UserController::class, 'login'] );
Route::post( 'user-register', [UserController::class, 'register'] );
Route::post( 'password/forgot-password', [UserController::class, 'sendResetLinkResponse'] );
Route::post( 'password/reset', [UserController::class, 'sendResetResponse'] );

Route::group( ['middleware' => ['auth:user', 'scopes:user']], function () {
    // Login Related Route
    Route::post( 'user-logout', [UserController::class, 'logOut'] );
    Route::post( 'password-change', [UserController::class, 'passwordChange'] );

    // FavList or WishList
    Route::post( 'add-wishlist', [WishListController::class, 'addWishList'] );
    Route::delete( 'delete-wishproduct/{productId}', [WishListController::class, 'deleteWishProduct'] );
    Route::get( 'all-wishlist', [WishListController::class, 'allWishList'] );

    //Cart
    Route::post( 'add-cart', [CartController::class, 'addCart'] );
    Route::get( 'cart-list', [CartController::class, 'cartList'] );
    Route::post( 'update-cart', [CartController::class, 'updateCart'] );
    Route::delete( 'delete-cart/{productId}', [CartController::class, 'deleteCart'] );
} );
