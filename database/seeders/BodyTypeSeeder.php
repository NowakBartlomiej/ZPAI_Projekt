<?php

namespace Database\Seeders;

use App\Models\BodyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class BodyTypeSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;
    
    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/body_types.csv"), 'r');

        $firstLine = true;
        while(($data = fgetcsv($csvFile, 100, ',')) !== FALSE) {
            if (!$firstLine) {
                BodyType::create(
                    [
                        "name" => $data['0'],
                        'created_at' => $this->faker->dateTimeBetween(
                            '- 8 weeks',
                            '- 4 weeks',
                        ),
                        'updated_at' => $this->faker->dateTimeBetween(
                            '- 4 weeks',
                            '- 1 week'
                        ),
                        'deleted_at' => null,
                    ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
