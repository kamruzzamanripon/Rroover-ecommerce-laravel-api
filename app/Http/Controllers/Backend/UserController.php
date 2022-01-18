<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\repositories\BackendAuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    public $authRepository;

    public function __construct( BackendAuthRepository $authRepository ) {
        $this->authRepository = $authRepository;
    }

    public function login( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ] );

        if ( $validator->fails() ) {
            return response()->json( ['error' => $validator->errors()->all()] );
        }

        try {
            $user = $this->authRepository->findUserByEmailAddress( $request->email );

            if ( isset( $user ) ) {

                if ( $HashCheck = $this->authRepository->login( $request, $user ) ) {

                    $tokenInfo = $user;
                    $tokenInfo['token'] = $user->createToken( 'MyApp', ['admin'] )->accessToken;
                    $cookie = cookie( 'token', $tokenInfo->token, 60 * 24 ); //1day

                    return response()->json( [
                        "success"    => true,
                        "message"    => "User logged in successfully",
                        "token_info" => $tokenInfo,
                    ] )->withCookie( $cookie );
                } else {

                    return response()->json( [
                        "status"  => 0,
                        "message" => "Password didn't match",
                    ], 404 );
                }
            } else {

                return response()->json( [
                    "status"  => 0,
                    "message" => "User not found",
                ], 404 );
            }
        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 500 );
        }

    }

    public function logOut( Request $request ) {

        // Log Out Current device
        $accessToken = Auth::user()->token();
        $token = $request->user()->tokens->find( $accessToken );
        $token->revoke();

        $cookie = Cookie::forget( 'token' );

        //Log Out All Device
        // $allToken = User::find( $accessToken->user_id )->tokens->pluck( 'id' );
        // foreach ( $allToken as $token ) {
        //     $token = $request->user()->tokens->find( $token );
        //     $token->revoke();
        // }

        return response( [
            'message' => 'LogOut Success',
            'token'   => $token,
        ] )->withCookie( $cookie );
    }
}
