<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            Member::create([
                'name' => $faker->name,
                'gender' => $faker->randomElement(['M', 'F']),
                'phone_number' => '0857' . $faker->randomNumber(8),
                'address' => $faker->address,
                'email' => $faker->email,
            ]);
        }
    }
}
