<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Remera Oficial Legion Nueva Era',
            'descripcion' => 'Remera de algodón estampada. Talle único.',
            'precio' => 15000,
        ]);

         Producto::create([
            'nombre' => 'Entrada Show Legion Nueva era: La cumbia Legionaria',
            'descripcion' => 'Acceso general al evento del 5 de junio.',
            'precio' => 7500,
        ]);
    }
}
