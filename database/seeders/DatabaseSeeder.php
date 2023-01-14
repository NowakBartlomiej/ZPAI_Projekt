<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\FuelSeeder;
use Database\Seeders\MakeSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdvertSeeder;
use Database\Seeders\BodyTypeSeeder;
use Database\Seeders\CarModelSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'User Test',
        //     'email' => 'user.test@localhost',
        //     'password' => Hash::make('12345678')
        // ]);

        $this->call(CategorySeeder::class);
        $this->call(MakeSeeder::class);
        $this->call(FuelSeeder::class);
        $this->call(CountySeeder::class);
        $this->call(BodyTypeSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(AdvertSeeder::class);
    }
}
