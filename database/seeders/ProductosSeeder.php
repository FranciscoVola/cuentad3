<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        // Crear carpeta si no existe
        Storage::disk('public')->makeDirectory('productos');

        $nombreFinal = 'productos/' . Str::random(10) . '_producto1.jpg';

        // Copiar la imagen desde database/seeders/images a storage/app/public/productos
        $origen = database_path('seeders/images/producto1.jpg');
        $destino = storage_path('app/public/' . $nombreFinal);
        copy($origen, $destino);

        // Crear producto
        Producto::create([
            'nombre' => 'Remera CUENTAD3',
            'descripcion' => 'Remera oficial de la comunidad de lucha libre argentina.',
            'precio' => 4500,
            'imagen' => $nombreFinal,
        ]);
    }
}
