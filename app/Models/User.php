<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Si usas roles
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles; // Si usas roles
    use HasFactory;
    use Notifiable;

    /**
     * Los atributos que pueden ser asignados en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',  // Tipo de usuario: trabajador o empleador
    ];

    /**
     * Los atributos que deben ser ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Seguridad en el manejo de contraseñas
        ];
    }

    /**
     * Relación con el trabajador (si el usuario es un trabajador)
     */
    public function trabajador()
    {
        return $this->hasOne(Trabajador::class);
    }

    /**
     * Relación con el empleador (si el usuario es un empleador)
     */
    public function empleador()
    {
        return $this->hasOne(Empleador::class);
    }

    
}

