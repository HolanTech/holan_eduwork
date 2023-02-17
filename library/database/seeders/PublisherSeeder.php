<?php

namespace Database\Seeders;

use App\Models\publisher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $publisher = new publisher;

            $publisher->name = "Publisher 0" . $i;
            $publisher->email = $faker->email;
            $publisher->phone_number = '0853' . $faker->randomNumber(8);
            $publisher->address = $faker->address;

            $publisher->save();
        }
    }
}
