<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $price    = fake()->randomFloat(2, 10, 300);
        $quantity = fake()->numberBetween(1, 5);

        return [
            
            'order_id'  => Order::factory(), 
            'sku'       => 'SKU-' . fake()->unique()->numerify('#####'),
            'price'     => $price,
            'quantity'  => $quantity,
            'line_total'=> $price * $quantity,
        ];
    }
}
