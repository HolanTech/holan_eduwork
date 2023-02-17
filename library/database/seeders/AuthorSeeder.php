<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory as faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();

        for ($i = 0; $i < 20; $i++) {
            $author = new Author;

            $author->name = $faker->name;
            $author->email = $faker->email;
            $author->phone_number = '0821' . $faker->randomNumber(8);
            $author->address = $faker->address;

            $author->save();
        }
    }
}
