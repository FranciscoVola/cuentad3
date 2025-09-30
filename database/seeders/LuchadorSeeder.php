<?php

namespace Database\Seeders;

use App\Models\Luchador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LuchadorSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que el directorio exista
        Storage::disk('public')->makeDirectory('luchadores');

        $nombreFinal = 'luchadores/' . Str::random(10) . '_luchador1.jpg';

        // Copiar la imagen desde database/seeders/images a storage/app/public/luchadores
        $origen = database_path('seeders/images/luchador1.jpg');
        $destino = storage_path('app/public/' . $nombreFinal);
        copy($origen, $destino);

        // Crear luchador
        Luchador::create([
            'nombre' => 'Francisco Ackerman',
            'alias' => 'El Hater',
            'peso' => '70kg',
            'altura' => '1.70m',
            'ciudad_origen' => 'Buenos Aires',
            'biografia' => 'Un luchador con estilo emo y mirada desafiante.',
            'imagen' => $nombreFinal,
        ]);
    }
}
