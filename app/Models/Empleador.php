<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
class Empleador extends Model
{
    use HasFactory;

    // Definir la tabla si no sigue la convención plural
    protected $table = 'empleadores';

    // Los campos que pueden ser llenados en masa
    protected $fillable = [
        'nombre_empresa', 
        'dni', 
        'telefono', 
        'direccion', 
        'antecedentes', 
        'foto_perfil',
        'user_id',  // Relación con el usuario
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opiniones()
    {
        return $this->hasMany(Opinion::class);
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

}
