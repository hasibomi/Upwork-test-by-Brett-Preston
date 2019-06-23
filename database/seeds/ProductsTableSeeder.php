<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            \App\Product::create([
                'name' => $faker->name,
                'price' => $faker->randomFloat(2, 1, 100),
                'in_stock' => true
            ]);
        }
    }
}
