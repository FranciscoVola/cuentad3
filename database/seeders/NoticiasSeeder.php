<?php

namespace Database\Seeders;
use App\Models\Noticia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Noticia::create([
            'titulo' => 'CuentaDe3 lanza su plataforma oficial',
            'contenido' => 'La comunidad de lucha libre argentina ya tiene su espacio online profesional.',
            'imagen' => 'noticia1.jpg',
            'fecha' => now(),
        ]);

        Noticia::create([
            'titulo' => 'Proximo evento confirmado Viernes 6 de Junio',
            'contenido' => 'Contará con luchadores independientes y combates sorpresa.',
            'imagen' => 'noticia2.jpg',
            'fecha' => now(),
        ]);
    }
    
}
