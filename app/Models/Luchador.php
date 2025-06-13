<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Luchador extends Model
{
    protected $fillable = [
    'nombre',
    'alias',
    'imagen',
    'peso',
    'altura',
    'ciudad_origen',
    'biografia'
];
}
