<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionWebSeeder extends Seeder
{
    private string $filePath = "roles_permissions_data/roles_permissions_web.json";
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $filePath = storage_path(path: $this->filePath);
        $jsonContent = file_get_contents(filename: $filePath);
        $data = json_decode($jsonContent, true);
        $dataSuperAdmin = $data['Super-Administrator'];

        // create all permissions
        foreach ($dataSuperAdmin as $key => $value) {
            $existingPermission = Permission::where('name', $value)->first();

            if (!$existingPermission) { Permission::create(attributes: ['name' => $value]); }
        }

        // create role super administrator
        $roleSuperAdmin = Role::where(column: 'name', operator: '=', value: "Super-Administrator")->first();

        if (!$roleSuperAdmin) { $roleSuperAdmin = Role::create(attributes: ['name' => "Super-Administrator"]); }

        // sync permissions to role super administrator
        $permissionsSuperAdmin = Permission::pluck(column: 'id', key: 'id');
        $roleSuperAdmin->syncPermissions($permissionsSuperAdmin);

        // create super administrator account and assign role to it
        $superAdmin = User::where(column: 'email', operator: '=', value: env(key: 'SUPER_ADMIN_WEB_EMAIL'))->first();

        if (!$superAdmin) {
            $superAdmin = User::create(
                attributes: [
                    'first_name' => env(key: 'SUPER_ADMIN_WEB_FIRSTNAME', default: "Super"),
                    'last_name' => env(key: 'SUPER_ADMIN_WEB_LASTNAME', default: "Administrator"),
                    'email' => env(key: 'SUPER_ADMIN_WEB_EMAIL'),
                    'password' => Hash::make(value: env(key: 'SUPER_ADMIN_WEB_PASSWORD')),
                    'email_verified_at' => Carbon::now(),
                ]
            );
            
            $superAdmin->assignRole($roleSuperAdmin->id);
        }

        // create role administrator and assign permissions to it
        $roleAdmin = Role::where(column: 'name', operator: '=', value: "Administrator")->first();

        if (!$roleAdmin) {
            $roleAdmin = Role::create(attributes: ['name' => "Administrator"]);
        }

        // sync permissions to role administrator
        $permissionsAdmin = Permission::query()->whereIn('name', $data['Administrator'])->pluck(column: 'id', key: 'id');
        $roleAdmin->syncPermissions($permissionsAdmin);

        // create role user and assign permissions to it
        $roleUser = Role::where(column: 'name', operator: '=', value: "User")->first();

        if (!$roleUser) {
            $roleUser = Role::create(attributes: ['name' => "User"]);
        }

        // sync permissions to role user
        $permissionsUser = Permission::query()->whereIn('name', $data['User'])->pluck(column: 'id', key: 'id');
        $roleAdmin->syncPermissions($permissionsUser);
    }
}
