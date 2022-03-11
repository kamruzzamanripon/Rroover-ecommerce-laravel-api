<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {

            $permissions = Permission::all();

            return response()->json( [
                "success"         => true,
                "message"         => "Permission info",
                "Permission_info" => $permissions,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {

        $request->validate( [
            'name' => 'required|unique:users,name',
        ] );

        try {

            //$permissions = Permission::create( $request->only( 'name' ) );
            $permissions = new Permission();
            $permissions->name = $request->name;
            $permissions->group_name = $request->group_name;
            $permissions->save();

            return response()->json( [
                "success"         => true,
                "message"         => "Permission info",
                "Permission_info" => $permissions,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {

        $request->validate( [
            'name' => 'required|unique:permissions,name,' . $id,
        ] );

        try {

            $permission = Permission::where( 'id', $id )->first();
            //$permission->update( $request->only( 'name' ) );
            $permission->name = $request->name;
            $permission->group_name = $request->group_name ? $request->group_name : $permission->group_name;
            $permission->update();

            return response()->json( [
                "success"         => true,
                "message"         => "Permission info",
                "Permission_info" => $permission,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {

        try {

            $permission = Permission::where( 'id', $id )->first();
            $permission->delete();

            return response()->json( [
                "success"         => true,
                "message"         => "Permission info",
                "Permission_info" => $permission,
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

    /**
     * specifice permission on user.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function userPermissionAssign( $permissionId ) {

        try {

            $user_id = Auth::user()->id;
            $user = Admin::with( 'roles' )->where( 'id', $user_id )->first();
            $permission = Permission::findById( $permissionId );

            $user->givePermissionTo( $permission->name ); // stores the relationship
            //return dd( $permission );

            return response()->json( [
                "success"         => true,
                "message"         => "Permission info",
                "Permission_info" => $user,
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
