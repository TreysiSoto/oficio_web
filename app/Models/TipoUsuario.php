<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuarios';

    // Si no usas la columna "id" como clave primaria, especifica el nombre de la clave primaria
    protected $primaryKey = 'id';

    // Desactivar la administración automática de timestamps si no los usas
    public $timestamps = true;

    // Definir los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Método para obtener los tipos de usuarios
    public static function getTiposUsuarios()
    {
        return self::all(); // Retorna todos los tipos de usuarios disponibles
    }
}
