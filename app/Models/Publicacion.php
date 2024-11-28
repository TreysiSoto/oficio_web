<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Empleador;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones'; // Define la tabla que se usará

    protected $fillable = [
        'descripcion', // Atributos que se pueden asignar masivamente
        'fecha_publicacion',
        'estado',
        'direccion',
        'empleador_id',
    ];
 // Si quieres que Laravel trate 'fecha_publicacion' como una fecha
    protected $dates = ['fecha_publicacion'];

    // Relación con el modelo Empleador (uno a muchos, inversa)
    public function empleador()
    {
        return $this->belongsTo(Empleador::class, 'empleador_id');
    }

    
    
}
