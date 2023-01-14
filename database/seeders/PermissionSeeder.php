<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ? Users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);

        // ? Logs
        Permission::create(['name' => 'log-viewer']);

        // ? Categories
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.manage']);

        // ? Makes
        Permission::create(['name' => 'makes.index']);
        Permission::create(['name' => 'makes.manage']);

        // ? Fuels
        Permission::create(['name' => 'fuels.index']);
        Permission::create(['name' => 'fuels.manage']);

        // ? Counties
        Permission::create(['name' => 'counties.index']);
        Permission::create(['name' => 'counties.manage']);

        // ? Body type
        Permission::create(['name' => 'bodyTypes.index']);
        Permission::create(['name' => 'bodyTypes.manage']);

        // ? City
        Permission::create(['name' => 'cities.index']);
        Permission::create(['name' => 'cities.manage']);

        // ? Car model
        Permission::create(['name' => 'carModels.index']);
        Permission::create(['name' => 'carModels.manage']);

        // ? Car
        Permission::create(['name' => 'cars.index']);
        Permission::create(['name' => 'cars.manage']);
        
        // ? Advert
        Permission::create(['name' => 'adverts.index']);
        Permission::create(['name' => 'adverts.manage']);

        // ? Admin
        $adminRole = Role::findByName(config('auth.roles.admin'));
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.change_role');

        $adminRole->givePermissionTo('log-viewer');

        $adminRole->givePermissionTo('categories.index');
        $adminRole->givePermissionTo('categories.manage');

        $adminRole->givePermissionTo('makes.index');
        $adminRole->givePermissionTo('makes.manage');

        $adminRole->givePermissionTo('fuels.index');
        $adminRole->givePermissionTo('fuels.manage');

        $adminRole->givePermissionTo('counties.index');
        $adminRole->givePermissionTo('counties.manage');

        $adminRole->givePermissionTo('bodyTypes.index');
        $adminRole->givePermissionTo('bodyTypes.manage');

        $adminRole->givePermissionTo('cities.index');
        $adminRole->givePermissionTo('cities.manage');

        $adminRole->givePermissionTo('carModels.index');
        $adminRole->givePermissionTo('carModels.manage');

        $adminRole->givePermissionTo('cars.index');
        $adminRole->givePermissionTo('cars.manage');

        $adminRole->givePermissionTo('adverts.index');
        $adminRole->givePermissionTo('adverts.manage');

        // ? Worker
        $workerRole = Role::findByName(config('auth.roles.worker'));

        $workerRole->givePermissionTo('categories.index');
        $workerRole->givePermissionTo('categories.manage');

        $workerRole->givePermissionTo('makes.index');
        $workerRole->givePermissionTo('makes.manage');

        $workerRole->givePermissionTo('fuels.index');
        $workerRole->givePermissionTo('fuels.manage');

        $workerRole->givePermissionTo('counties.index');
        $workerRole->givePermissionTo('counties.manage');

        $workerRole->givePermissionTo('bodyTypes.index');
        $workerRole->givePermissionTo('bodyTypes.manage');

        $workerRole->givePermissionTo('cities.index');
        $workerRole->givePermissionTo('cities.manage');

        $workerRole->givePermissionTo('carModels.index');
        $workerRole->givePermissionTo('carModels.manage');

        $workerRole->givePermissionTo('cars.index');
        $workerRole->givePermissionTo('cars.manage');

        $workerRole->givePermissionTo('adverts.index');
        $workerRole->givePermissionTo('adverts.manage');

        // ? User
        $userRole = Role::findByName(config('auth.roles.user'));

        $userRole->givePermissionTo('categories.index');

        $userRole->givePermissionTo('makes.index');
        
        $userRole->givePermissionTo('fuels.index');

        $userRole->givePermissionTo('counties.index');
        
        $userRole->givePermissionTo('bodyTypes.index');
        
        $userRole->givePermissionTo('cities.index');

        $userRole->givePermissionTo('carModels.index');

        $userRole->givePermissionTo('cars.index');

        $userRole->givePermissionTo('adverts.index');
        $userRole->givePermissionTo('adverts.manage');
    }
}
