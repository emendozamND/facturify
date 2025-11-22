<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 100, 1000);
        $discountCode = fake()->randomElement(['PROMO10', 'FREESHIP', null]);

        $discount = match ($discountCode) {
            'PROMO10'  => round($subtotal * 0.10, 2),
            'FREESHIP' => 50,
            default    => 0,
        };

        $tax   = round($subtotal * 0.16, 2);
        $total = $subtotal - $discount + $tax;

        return [
            'external_id'   => 'ORD-' . fake()->unique()->numerify('#####'),
            'discount_code' => $discountCode,
            'subtotal'      => $subtotal,
            'discount'      => $discount,
            'tax'           => $tax,
            'total'         => $total,
        ];
    }
}
