<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\OrderItem;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          Order::factory()
            ->count(10)
            ->has(
                OrderItem::factory()->count(rand(2, 5)),
                'items'
            )
            ->create();
    }
}
