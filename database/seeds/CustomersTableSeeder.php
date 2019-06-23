<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 200; $i++) {
            \App\Customer::create([
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}
