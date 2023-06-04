<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Itinerary;
use App\Models\Station;
use App\Models\Trip;
use App\Models\TripTracks;
use App\Models\User;
use App\Models\Vehicles;
use BezhanSalleh\FilamentShield\Support\Utils;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->roles();

        User::factory()
            ->create([
                'name'     => 'User',
                'email'    => 'client@test.com',
                'password' => Hash::make(123456789),
            ])
            ->assignRole('client');
        User::factory()
            ->create([
                'name'     => 'Admin',
                'email'    => 'admin@test.com',
                'password' => Hash::make(123456789)
            ])
            ->assignRole('super_admin');
        $stations = [
            [
                'name' => 'Cairo'
            ],
            [
                'name' => 'Alexandria'
            ],
            [
                'name' => 'Al-Minya'
            ],
            [
                'name' => 'Al-Fayyum'
            ],
            [
                'name' => 'Asyut'
            ],
        ];
        Station::insert($stations);

        Vehicles::factory(5)
                ->create();

        $trips = array(
            array(
                'trip_reference'      => 'T-2306010000001',
                'cost'                => '75.50',
                'starting_station_id' => 1,
                'ending_station_id'   => 5,
                'vehicle_id'          => Vehicles::inRandomOrder()
                                                 ->first()->id,
                'start_date'          => Carbon::now()
                                               ->addHour(12),
                'end_date'            => Carbon::now()
                                               ->addHour(15),
            ),
            array(
                'trip_reference'      => 'T-2306010000002',
                'cost'                => '55.00',
                'starting_station_id' => 1,
                'ending_station_id'   => 3,
                'vehicle_id'          => Vehicles::inRandomOrder()
                                                 ->first()->id,
                'start_date'          => Carbon::now()
                                               ->addHour(6),
                'end_date'            => Carbon::now()
                                               ->addHour(7),
            )
        );
        Trip::insert($trips);

        $itineraries = array(
            array(
                'trip_id'    => 1,
                'station_id' => '4',
                'sort'       => '2',
            ),
            array(
                'trip_id'    => 1,
                'station_id' => '3',
                'sort'       => '3',
            ),
            array(
                'trip_id'    => 2,
                'station_id' => '4',
                'sort'       => '4',
            )
        );
        Itinerary::insert($itineraries);

        $trip_tracks = array(
            array('trip_id' => 2,'from_station_id' => '1','to_station_id' => '4'),
            array('trip_id' => 2,'from_station_id' => '1','to_station_id' => '3'),
            array('trip_id' => 2,'from_station_id' => '4','to_station_id' => '3'),
            array('trip_id' => 1,'from_station_id' => '1','to_station_id' => '4'),
            array('trip_id' => 1,'from_station_id' => '1','to_station_id' => '3'),
            array('trip_id' => 1,'from_station_id' => '1','to_station_id' => '5'),
            array('trip_id' => 1,'from_station_id' => '4','to_station_id' => '3'),
            array('trip_id' => 1,'from_station_id' => '4','to_station_id' => '5'),
            array('trip_id' => 1,'from_station_id' => '3','to_station_id' => '5')
        );
        TripTracks::insert($trip_tracks);

    }

    private function roles()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_reservation","view_any_reservation","create_reservation","update_reservation","restore_reservation","restore_any_reservation","replicate_reservation","reorder_reservation","delete_reservation","delete_any_reservation","force_delete_reservation","force_delete_any_reservation","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_station","view_any_station","create_station","update_station","restore_station","restore_any_station","replicate_station","reorder_station","delete_station","delete_any_station","force_delete_station","force_delete_any_station","view_trip","view_any_trip","create_trip","update_trip","restore_trip","restore_any_trip","replicate_trip","reorder_trip","delete_trip","delete_any_trip","force_delete_trip","force_delete_any_trip","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_vehicles","view_any_vehicles","create_vehicles","update_vehicles","restore_vehicles","restore_any_vehicles","replicate_vehicles","reorder_vehicles","delete_vehicles","delete_any_vehicles","force_delete_vehicles","force_delete_any_vehicles","page_MyProfile"]},{"name":"client","guard_name":"web","permissions":["view_reservation","view_any_reservation"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (!blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name'       => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (!blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])->each(function ($permission) use ($permissionModels) {
                        $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                            'name'       => $permission,
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
        if (!blank($permissions = json_decode($directPermissions,true))) {

            foreach ($permissions as $permission) {

                if (
                    Utils::getPermissionModel()::whereName($permission)
                         ->doesntExist()
                ) {
                    Utils::getPermissionModel()::create([
                        'name'       => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
