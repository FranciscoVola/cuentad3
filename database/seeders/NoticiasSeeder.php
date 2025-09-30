<?php

namespace Database\Seeders;

use App\Models\Noticia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiasSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que el directorio exista
        Storage::disk('public')->makeDirectory('noticias');

        $noticias = [
            [
                'titulo' => 'CUENTAD3 lanza su plataforma oficial',
                'contenido' => 'La comunidad de lucha libre argentina ya tiene su espacio online profesional.',
                'imagen' => 'noticia1.jpg',
            ],
            [
                'titulo' => 'Próximo evento confirmado Domingo 27 de Julio',
                'contenido' => 'Contará con luchadores independientes y combates sorpresa.',
                'imagen' => 'noticia2.jpg',
            ],
        ];

        foreach ($noticias as $data) {
            $nombreFinal = 'noticias/' . Str::random(10) . '_' . $data['imagen'];

            // Copiar la imagen desde database/seeders/images a storage/app/public/noticias
            $origen = database_path('seeders/images/' . $data['imagen']);
            $destino = storage_path('app/public/' . $nombreFinal);
            copy($origen, $destino);

            Noticia::create([
                'titulo' => $data['titulo'],
                'contenido' => $data['contenido'],
                'fecha' => now(),
                'imagen' => $nombreFinal, // ruta correcta para Storage::url()
            ]);
        }
    }
}
