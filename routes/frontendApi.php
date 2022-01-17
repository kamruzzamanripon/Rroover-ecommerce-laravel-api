<?php

use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ListController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

//http://localhost:8000/api/v1/frontend/test
// Route::get( 'test', function () {
//     return "hello Ripon, how are youxxx";
// } );

Route::get( 'main-banner', [BannerController::class, 'index'] );
Route::get( 'single-banner', [BannerController::class, 'singleBanner'] );

Route::get( 'mens-latest-product/{query}', [ProductController::class, 'mensLatestPeoduct'] );
Route::get( 'mens-hotdeals', [ProductController::class, 'mensHotDeals'] );
Route::get( 'womens-latest-product/{query}', [ProductController::class, 'womensLatestPeoduct'] );
Route::get( 'toys-latest-product/{query}', [ProductController::class, 'toysLatestPeoduct'] );
Route::get( 'mobile-tablet/{query}', [ProductController::class, 'mobileTabletPeoduct'] );
Route::get( 'books-audiable/{query}', [ProductController::class, 'bookAudiablePeoduct'] );
Route::get( 'beauty-health/{query}', [ProductController::class, 'beautyHealthPeoduct'] );
Route::get( 'single-product/{id}', [ProductController::class, 'singleProduct'] );

Route::get( 'category-list', [ListController::class, 'categoryList'] );
Route::get( 'brand-list', [ListController::class, 'brandList'] );
Route::get( 'single-category/{id}', [ListController::class, 'singleCategory'] )->name( 'singleCategory' );
Route::get( 'single-category-products', [ListController::class, 'singleCategoryProducts'] );
Route::get( 'subcategory/{catid}/{subid}', [ListController::class, 'subcategoryProducts'] );
Route::get( 'single-brand/{brandid}', [ListController::class, 'singleBrandProducts'] );

Route::get( 'new-arrivals', [ProductController::class, 'newArrivals'] );
Route::get( 'exclusive-deals', [ProductController::class, 'exclusiveDeals'] );
Route::get( 'flash-deals', [ProductController::class, 'flashDeals'] );
Route::get( 'super-sales', [ProductController::class, 'superSales'] );

Route::post('add-wishlist', [CartController::class, 'addWishList']);
Route::get('all-wishlist', [CartController::class, 'allWishList']);