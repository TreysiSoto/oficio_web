<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    // Definir la tabla si no sigue la convención plural
    protected $table = 'trabajadores';

    // Los campos que pueden ser llenados en masa
    protected $fillable = [
        'dni',
        'direccion',
        'telefono',
        'trabajo',
        'antecedentes',
        'foto_perfil',
        'user_id',  // Relación con el usuario
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function empleador()
    {
        return $this->belongsTo(Empleador::class);
    }
    public function opiniones()
    {
        return $this->hasMany(Opinion::class);
    }


}
