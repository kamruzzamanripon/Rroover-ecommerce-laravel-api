<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\repositories\AuthRepository;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;

class UserController extends Controller {

    public $authRepository;

    public function __construct( AuthRepository $authRepository ) {
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
                    $tokenInfo['token'] = $user->createToken( 'MyApp', ['user'] )->accessToken;
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
        ] )->withCookie( $cookie );
    }

    public function register( RegisterRequest $request ) {

        try {

            $newUser = $this->authRepository->register( $request );

            return response()->json( [
                "success" => true,
                "message" => "registered succesfully",
                "newUser" => $newUser,
            ] );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 500 );
        }

    }

    //Forget Passport 1st Step
    public function sendResetLinkResponse( Request $request ) {

        $input = $request->only( 'email' );
        $validator = Validator::make( $input, [
            'email' => "required|email",
        ] );
        if ( $validator->fails() ) {
            return response( ['errors' => $validator->errors()->all()], 422 );
        }

        $response = Password::sendResetLink( $input );
        if ( $response == Password::RESET_LINK_SENT ) {
            $message = "Mail send successfully";
        } else {
            $message = "Email could not be sent to this email address";
        }
//$message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
        $response = ['data' => '', 'message' => $message];

        return response()->json( [
            "success"               => true,
            "message"               => "Mail send succesfully",
            "passwordChangeRequest" => $response,
        ] );
    }

    //Forget Passport 2nd Step
    public function sendResetResponse( Request $request ) {
        //password.reset
        $input = $request->only( 'email', 'token', 'password', 'password_confirmation' );
        $validator = Validator::make( $input, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
        ] );
        if ( $validator->fails() ) {
            return response( ['errors' => $validator->errors()->all()], 422 );
        }

        $response = Password::reset( $input, function ( $user, $password ) {
            $user->forceFill( [
                'password' => Hash::make( $password ),
            ] )->save();
            //$user->setRememberToken(Str::random(60));
            event( new PasswordReset( $user ) );
        } );
        if ( $response == Password::PASSWORD_RESET ) {
            $message = "Password reset successfully";
        } else {
            $message = "Email could not be sent to this email address";
        }
        $response = ['data' => '', 'message' => $message];
        return response()->json( $response );
    }

    public function passwordChange( PasswordChangeRequest $request ) {

        $passwordChangeRequest = $this->authRepository->passwordChange( $request );

        return response()->json( [
            "success"               => true,
            "message"               => "Password Change succesfully",
            "passwordChangeRequest" => $passwordChangeRequest,
        ] );

    }

}
