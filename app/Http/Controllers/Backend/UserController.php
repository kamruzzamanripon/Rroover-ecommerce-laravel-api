<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\repositories\BackendAuthRepository;
use App\Http\Requests\AdminForgotPasswordResetRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Resources\AdminAllUserResource;
use App\Http\Resources\AdminResource;
use App\Mail\ForgotMail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        //if validation fail
        if ( $validator->fails() ) {
            return response()->json( ['error' => $validator->errors()->all()] );
        }

        try {

            //check email
            $user = $this->authRepository->findUserByEmailAddress( $request->email );

            //if email address true
            if ( isset( $user ) ) {

                if ( $HashCheck = $this->authRepository->login( $request, $user ) ) {

                    $tokenInfo = $user;
                    $tokenInfo['token'] = $user->createToken( 'MyApp', ['admin'] )->accessToken;
                    $cookie = cookie( 'token', $tokenInfo->token, 60 * 24 ); //1day

                    $token = $tokenInfo->token;

                    $adminUserResources = new AdminResource( $tokenInfo );

                    //Super Admin create, first  run bleow this code 1st time than comment or delete
                    // $role = Role::where( 'id', 21 )->with( 'permissions' )->first();
                    // $user->roles()->detach();
                    // $permissions = Permission::pluck( 'id', 'id' )->all();
                    // $role->syncPermissions( $permissions );
                    // $user->assignRole( [$role->id] );

                    return response()->json( [
                        "success"    => true,
                        "message"    => "User logged in successfully",
                        "token_info" => $token,
                        "user_info"  => $adminUserResources,
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

    public function adminRegister( AdminRequest $request ) {

        try {

            $newUser = $this->authRepository->adminRegister( $request );

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

    //Forgot password 1st step
    public function forgotPassword( Request $request ) {

        $email = $request->only( 'email' );
        $validator = Validator::make( $email, [
            'email' => "required|email",
        ] );

        //Validation check
        if ( $validator->fails() ) {
            return response( ['errors' => $validator->errors()->all()], 422 );
        }
        //mail check
        if ( Admin::where( 'email', $email )->doesntExist() ) {
            return response( ['errors' => "Email Invalid"], 422 );
        }

        $token = rand( 10000000, 100000000 );
        //$token = Str::random(64);

        try {

            //Generate randome token
            DB::table( 'password_resets' )->insert( [
                'email'      => $request->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ] );

            Mail::to( $email )->send( new ForgotMail( $token ) );

            return response( [
                'message' => 'Reset password mail send on your email',
            ], 200 );

        } catch ( \Exception $e ) {

            $error = $e->getMessage();
            return response()->json( [
                'success' => false,
                'message' => 'There is some Problems',
                'data'    => $error,
            ], 500 );
        }
    }

    //forgot password 2nd step
    public function forgotPasswordReset( AdminForgotPasswordResetRequest $request ) {

        $email = $request->email;
        $token = $request->token;
        $password = Hash::make( $request->password );

        $emailCheck = DB::table( 'password_resets' )->where( 'email', $email )->first();
        $pinCheck = DB::table( 'password_resets' )->where( 'token', $token )->first();

        if ( !$emailCheck ) {
            return response( [
                'message' => 'Email not Found',
            ], 401 );
        }
        if ( !$pinCheck ) {
            return response( [
                'message' => 'Pincode  Invalid',
            ], 401 );
        }

        DB::table( 'admins' )->where( 'email', $email )->update( ['password' => $password] );
        DB::table( 'password_resets' )->where( 'email', $email )->delete();

        return response( [
            'message' => 'Password Change Successfully',
        ], 200 );

    }

    //password change function
    public function passwordChange( PasswordChangeRequest $request ) {

        try {
            $passwordChangeRequest = $this->authRepository->passwordChange( $request );

            return response()->json( [
                "success"               => true,
                "message"               => "Password Change succesfully",
                "passwordChangeRequest" => $passwordChangeRequest,
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

    //All User List with their role and role related Permission List
    public function adminUserList() {

        try {
            $users = Admin::paginate( 3 );
            $user_roles = [];
            $user_permissions = [];
            if ( $users ) {
                foreach ( $users AS $user ) {
                    $user_roles[$user->id] = $user->getRoleNames();
                    $user_permissions[$user->id] = $user->getAllPermissions();
                }
            }

            $adminUserList = AdminAllUserResource::collection( $users )->response()->getData( true );

            return response()->json( [
                "success"       => true,
                "message"       => "Admin All user List",
                "adminUserList" => $adminUserList,
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

}
