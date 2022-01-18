<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

//http://localhost:8000/api/v1/backend/test

Route::post( 'user-login', [UserController::class, 'login'] );

Route::group( ['middleware' => ['auth:admin', 'scopes:admin']], function () {
    
    Route::get( 'test', function () {
        return "hello Ripon, how are youxxx";
    } );

    Route::post( 'user-logout', [UserController::class, 'logOut'] );
} );