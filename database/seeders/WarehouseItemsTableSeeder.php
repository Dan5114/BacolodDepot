<?php

// database/seeders/WarehouseItemsTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseItemsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('warehouse_items')->insert([
            [
                'name' => 'Laptop',
                'description' => 'Dell Inspiron 15',
                'quantity' => 10,
                'price' => 50000.00,
                'date_added' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'description' => 'Mechanical keyboard',
                'quantity' => 25,
                'price' => 1500.00,
                'date_added' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse',
                'description' => 'Wireless mouse',
                'quantity' => 50,
                'price' => 800.00,
                'date_added' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}