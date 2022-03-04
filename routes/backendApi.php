<?php

use App\Http\Controllers\Backend\CategoryController;
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

} );
