<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trabajador;
use App\Models\Empleador;

class Opinion extends Model
{
    use HasFactory;
    protected $table = 'opiniones';

    protected $fillable = [
        'empleador_id',
        'trabajador_id',
        'calificacion',
        'mensaje',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime', 
    ];
    // Relación con el modelo Empleador
    public function empleador()
    {
        return $this->belongsTo(Empleador::class, 'empleador_id');
    }

    // Relación con el modelo Trabajador
    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

}
