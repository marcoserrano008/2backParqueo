<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'mensaje',
        'tipo',
        'id_usuario',
        'fecha'
    ];

    // Definir relaciones u otros métodos según tus necesidades
}
