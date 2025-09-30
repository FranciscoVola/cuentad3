<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;


class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'categoria_id', 'imagen'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
