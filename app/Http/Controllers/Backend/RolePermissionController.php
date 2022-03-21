<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller {

    public function roleAll() {
        try {

            $roles = Role::all();

            //$permission_groups = Admin::getpermissionGroups();
            //$Allpermission = Permission::get();

            return response()->json( [
                "success" => true,
                "message" => "Role all data",
                "roles"   => $roles,
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

    public function roleAllWithPagination() {
        try {

            $roles = Role::with( 'permissions' )->orderBy( 'id', 'desc' )->paginate( 10 );

            $roles = RoleResource::collection( $roles )->response()->getData( true );

            //$permission_groups = Admin::getpermissionGroups();
            //$Allpermission = Permission::get();

            return response()->json( [
                "success" => true,
                "message" => "Role all data",
                "roles"   => $roles,
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

    public function roleSingle( $id ) {
        try {

            $role = Role::find( $id );
            $rolePermissions = Permission::join( 'role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id' )
                ->where( 'role_has_permissions.role_id', $id )
                ->get();

            return response()->json( [
                "success" => true,
                "message" => "Role Sigle data by user Id",
                "newUser" => $rolePermissions,
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

    public function roleCreate( Request $request ) {
        //return dd( $request->input( 'permissions' ) );

        try {

            // Validation Data
            $request->validate( [
                'name' => 'required|max:100|unique:roles',
            ], [
                'name.requried' => 'Please give a role name',
            ] );

            // Process Data
            //$role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
            $role = Role::create( ['name' => $request->name] );

            // $role = DB::table('roles')->where('name', $request->name)->first();
            $permissions = $request->input( 'permissions' );

            if ( !empty( $permissions ) ) {
                $role->syncPermissions( $permissions );
            }

            return response()->json( [
                "success" => true,
                "message" => "Role succesfully Create",
                "newUser" => $role,
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

    public function roleUpdate( Request $request, $id ) {
        try {

            // Validation Data
            $request->validate( [
                'name' => 'required|max:100|unique:roles,name,' . $id,
            ], [
                'name.requried' => 'Please give a role name',
            ] );

            $role = Role::findById( $id );
            $permissions = $request->input( 'permissions' );

            if ( !empty( $permissions ) ) {
                $role->name = $request->name;
                $role->save();
                $role->syncPermissions( $permissions );
            }

            return response()->json( [
                "success" => true,
                "message" => "Role succesfully Update",
                "newUser" => $role,
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

    public function roleDelete( $id ) {
        try {

            $role = Role::findById( $id, 'admin' );
            if ( !is_null( $role ) ) {
                $role->delete();
            }

            return response()->json( [
                "success" => true,
                "message" => "Role succesfully Delete",
                "newUser" => $role,
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

    public function userRollAssign( $roleId ) {

        $user_id = Auth::user()->id;
        $user = Admin::with( 'roles' )->where( 'id', $user_id )->first();
        $role = Role::findById( $roleId );

        if ( $role ) {
            $old_model_has_roll = DB::table( 'model_has_roles' )->where( 'model_id', $user_id )->delete();
        }

        //return dd( $old_model_has_roll );
        $user->assignRole( $role->name );

        return response()->json( [
            "success" => true,
            "message" => "Role succesfully Delete",
            "newUser" => $user,
        ] );

    }
}
