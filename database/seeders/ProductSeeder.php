<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //creacion de productos
         Product::create([
            'name' => 'LARAVEL Y LIVEWIRE',
            'price' =>350,
            'description' => '750110065987',
            'stock' => 1000,
            'image' => 'curso.png'
        ]);
    }
}
