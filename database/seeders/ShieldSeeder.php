<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
class ShieldSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_reservation","view_any_reservation","create_reservation","update_reservation","restore_reservation","restore_any_reservation","replicate_reservation","reorder_reservation","delete_reservation","delete_any_reservation","force_delete_reservation","force_delete_any_reservation","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_station","view_any_station","create_station","update_station","restore_station","restore_any_station","replicate_station","reorder_station","delete_station","delete_any_station","force_delete_station","force_delete_any_station","view_trip","view_any_trip","create_trip","update_trip","restore_trip","restore_any_trip","replicate_trip","reorder_trip","delete_trip","delete_any_trip","force_delete_trip","force_delete_any_trip","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_vehicles","view_any_vehicles","create_vehicles","update_vehicles","restore_vehicles","restore_any_vehicles","replicate_vehicles","reorder_vehicles","delete_vehicles","delete_any_vehicles","force_delete_vehicles","force_delete_any_vehicles","page_MyProfile"]},{"name":"client","guard_name":"web","permissions":["view_reservation","view_any_reservation"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web'
                            ]));
                        });
                    $role->syncPermissions($permissionModels);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
