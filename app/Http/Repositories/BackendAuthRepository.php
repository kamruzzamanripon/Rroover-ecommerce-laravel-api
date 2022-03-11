<?php

namespace App\Http\repositories;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BackendAuthRepository {
    public function login( Request $request, $user ) {

        $HashCheck = Hash::check( $request->password, $user->password );

        return $HashCheck;
    }

    public function findUserByEmailAddress( $email ) {
        $user = Admin::where( 'email', $email )->first();
        return $user;
    }

    public function userProfile( $id ) {
        $userProfile = Admin::where( 'id', $id )->first();

        return $userProfile;
    }

    public function adminRegister( $request ) {

        $author = new Admin();

        // if($request->hasfile('image')){

        //     $destination_path = 'public/image/user';
        //     //$name=$file->getClientOriginalName();
        //     $name = Carbon::now()->toDateString()."_".rand(666561, 544614449)."_.".$request->file('image')->getClientOriginalExtension();
        //     $path = $request->file('image')->storeAs($destination_path, $name);
        //     $image_path = 'storage/image/user/' . $name;

        // }

        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make( $request->password );
        //$author->avatar = $image_path;
        $author->save();

        //Role assign. Default as user
        if ( $request->roles ) {
            $author->assignRole( $request->roles );
        } else {
            $author->assignRole( "user" );
        }

        return $author;
    }

    public function passwordChange( $request ) {

        if ( auth()->user()->email === $request->email ) {

            $userInfo = Admin::find( auth()->user()->id )->update( ['password' => Hash::make( $request->new_password )] );
            return $userInfo;
        } else {
            return "you art not authorized";
        }

    }

}
