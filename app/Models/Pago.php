<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'pagado',
        'deuda',
        'id_reserva',
        'id_salida',
        'id_espacio'
    ];

    // Definir relaciones u otros métodos según tus necesidades
}
