<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advert::factory()->count(20)->create();
    }
}
