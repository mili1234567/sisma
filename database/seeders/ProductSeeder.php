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
            'name' => 'DELINEADOR DE OJOS EN CREMA',
            'price' =>35,
            'description' => 'delineador cafe  para ojos marca banana',
            'stock' => 50,
            'image' => '1.jpg'
        ]);
          //creacion de productos
          Product::create([
            'name' => 'RIMMEL MARCA MAYBELINE ',
            'price' =>35,
            'description' => 'rimel para osjos color negro maybeline ',
            'stock' => 60,
            'image' => '2.jpg'
        ]);
          //creacion de productos
          Product::create([
            'name' => 'ESPONJA PARA MAQUILLAJE SOLBEUTY',
            'price' =>10,
            'description' => 'esponja multiuso para maquillaje marca solbeuty',
            'stock' => 100,
            'image' => '3.jpg'
        ]);
    }
}
