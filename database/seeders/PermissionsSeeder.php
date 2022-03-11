<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Create Roles
        // $roleSuperAdmin = Role::create( ['name' => 'superadmin', 'guard_name' => 'admin'] );
        // $roleAdmin = Role::create( ['name' => 'admin', 'guard_name' => 'admin'] );
        // $roleEditor = Role::create( ['name' => 'editor', 'guard_name' => 'admin'] );
        // $roleUser = Role::create( ['name' => 'user', 'guard_name' => 'admin'] );

        // // Permission List as array
        // $permissions = [

        //     [
        //         'group_name'  => 'category',
        //         'permissions' => [
        //             'category.access',
        //             'category.create',
        //             'category.update',
        //             'category.delete',
        //         ],
        //     ],
        //     [
        //         'group_name'  => 'subcategory',
        //         'permissions' => [
        //             // Blog Permissions
        //             'subcategory.access',
        //             'subcategory.create',
        //             'subcategory.update',
        //             'subcategory.delete',
        //         ],
        //     ],

        // ];

        // // Create and Assign Permissions
        // for ( $i = 0; $i < count( $permissions ); $i++ ) {
        //     $permissionGroup = $permissions[$i]['group_name'];
        //     for ( $j = 0; $j < count( $permissions[$i]['permissions'] ); $j++ ) {
        //         // Create Permission
        //         $permission = Permission::create( ['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin'] );
        //         $roleSuperAdmin->givePermissionTo( $permission );
        //         $permission->assignRole( $roleSuperAdmin );
        //     }
        // }

        Admin::find( 2 )->assignRole( 'admin' );

    }
}
