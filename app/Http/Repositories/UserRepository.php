<?php

namespace App\Http\Repositories;

use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;

class UserRepository {

    public function userInfo( $userId ) {

        if ( Auth::check() && Auth::id() == $userId ) {
            $userInfo = UserInformation::where( 'user_id', $userId )->with( 'user' )->first();
            return $userInfo;
        } else {
            return $userInfo = [
                'data'    => "",
                'message' => "You Are not Authorized",
            ];
        }

    }

    public function userInfoCheck( $request ) {
        $user_id = $request->user_id;
        $address = $request->address;
        $city = $request->city;
        $zip_code = $request->zip_code;
        $mobile = $request->mobile;
        $shipping_alter = $request->shipping_alter ? $request->shipping_alter : false;
        $shipping_name = $request->shipping_name;
        $shipping_address = $request->shipping_address;
        $shipping_city = $request->shipping_city;
        $shipping_zipcode = $request->shipping_zipcode;
        $shipping_email = $request->shipping_email;
        $shipping_mobile = $request->shipping_mobile;

        $userCheckd = UserInformation::where( 'user_id', $user_id )->with( 'user' )->first();

        if ( Auth::check() && Auth::id() == $user_id ) {
            if ( !empty( $userCheckd ) ) {
                if ( $shipping_alter == true ) {

                    //$userData = new UserInformation;

                    $userCheckd->shipping_alter = $shipping_alter;
                    $userCheckd->shipping_name = $shipping_name;
                    $userCheckd->shipping_address = $shipping_address;
                    $userCheckd->shipping_city = $shipping_city;
                    $userCheckd->shipping_zipcode = $shipping_zipcode;
                    $userCheckd->shipping_email = $shipping_email;
                    $userCheckd->shipping_mobile = $shipping_mobile;
                    $userCheckd->update();

                    return $userData = $userCheckd;

                } else {
                    return $userData = $userCheckd;
                }
            } else {
                $userData = new UserInformation;

                $userData->user_id = $user_id;
                $userData->address = $address;
                $userData->city = $city;
                $userData->zip_code = $zip_code;
                $userData->mobile = $mobile;
                $userData->shipping_alter = $shipping_alter;
                $userData->shipping_name = $shipping_name;
                $userData->shipping_address = $shipping_address;
                $userData->shipping_city = $shipping_city;
                $userData->shipping_zipcode = $shipping_zipcode;
                $userData->shipping_email = $shipping_email;
                $userData->shipping_mobile = $shipping_mobile;
                $userData->save();

                return $userData;
            }
        } else {
            $userData = [
                'data'    => "",
                'message' => "Please Login your Account Or you Are not Authorized",
            ];
            return $userData;
        }
    }

    public function alterShippingInfo( $request ) {
        $user_id = $request->user_id;
        $shipping_alter = $request->shipping_alter ? $request->shipping_alter : false;
        $shipping_name = $request->shipping_name;
        $shipping_address = $request->shipping_address;
        $shipping_city = $request->shipping_city;
        $shipping_zipcode = $request->shipping_zipcode;
        $shipping_email = $request->shipping_email;
        $shipping_mobile = $request->shipping_mobile;

        $userCheckd = UserInformation::where( 'user_id', $user_id )->with( 'user' )->first();

        if ( Auth::check() && Auth::id() == $user_id ) {
            if ( !empty( $userCheckd ) ) {
                if ( $shipping_alter == true ) {

                    //$userData = new UserInformation;

                    $userCheckd->shipping_alter = $shipping_alter;
                    $userCheckd->shipping_name = $shipping_name;
                    $userCheckd->shipping_address = $shipping_address;
                    $userCheckd->shipping_city = $shipping_city;
                    $userCheckd->shipping_zipcode = $shipping_zipcode;
                    $userCheckd->shipping_email = $shipping_email;
                    $userCheckd->shipping_mobile = $shipping_mobile;
                    $userCheckd->update();

                    return $userData = $userCheckd;

                } else {
                    $userData = [
                        'data'    => "",
                        'message' => "Please Shipping alter convert True",
                    ];
                    return $userData;
                }
            } else {
                $userData = [
                    'data'    => "",
                    'message' => "Please Fillup your Basic Information",
                ];
                return $userData;
            }
        } else {
            $userData = [
                'data'    => "",
                'message' => "Please Login your Account Or you Are not Authorized",
            ];
            return $userData;
        }
    }

}