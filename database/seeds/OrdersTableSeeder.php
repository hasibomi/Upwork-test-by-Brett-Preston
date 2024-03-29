<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('orders')->truncate();
        \DB::table('order_items')->truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $total_amount = [];
            $customer = \App\Customer::find($i + 1);

            $order = \App\Order::create([
                'invoice_number' => $faker->numberBetween(1000, 9000),
                'total_amount' => 0.00,
                'status' => $faker->randomElement(['new', 'processed']),
                'customer_id' => $customer->id
            ]);

            for ($j = 0; $j < 5; $j++) {
                $quantity = $faker->numberBetween(1, 3);
                $product = \App\Product::find($j + 1);

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ]);

                array_push($total_amount, $product->price * $quantity);
            }

            $order->update([
                'total_amount' => array_sum($total_amount)
            ]);
        }
    }
}
