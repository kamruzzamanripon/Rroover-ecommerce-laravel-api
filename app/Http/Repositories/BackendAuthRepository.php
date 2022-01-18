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

    public function register( Request $request ) {
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

        return $author;
    }

    public function findUserByEmailAddress( $email ) {
        $user = Admin::where( 'email', $email )->first();
        return $user;
    }

    public function userProfile( $id ) {
        $userProfile = Admin::where( 'id', $id )->first();

        return $userProfile;
    }

}
