<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicacion;
use Carbon\Carbon;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos de ejemplo
        $publicaciones = [
            [
                'descripcion' => 'Se requiere un albañil para la reparación de techo con filtraciones en vivienda unifamiliar.',
                'fecha_publicacion' => Carbon::now()->subDays(7),
                'estado' => 'pendiente',
                'direccion' => 'Calle Los Olivos 112, Huánuco',
                'empleador_id' => 1,
            ],
            [
                'descripcion' => 'Se busca electricista para instalar un sistema de iluminación LED.',
                'fecha_publicacion' => Carbon::now()->subDays(6),
                'estado' => 'en progreso',
                'direccion' => 'Av. San Martín 234, Huánuco',
                'empleador_id' => 1,
            ],
            [
                'descripcion' => 'Construcción de un muro perimetral para una parcela agrícola.',
                'fecha_publicacion' => Carbon::now()->subDays(5),
                'estado' => 'pendiente',
                'direccion' => 'Carretera Central Km 10, Huánuco',
                'empleador_id' => 3,
            ],
            [
                'descripcion' => 'Limpieza y mantenimiento de canaletas en edificio residencial.',
                'fecha_publicacion' => Carbon::now()->subDays(4),
                'estado' => 'finalizado',
                'direccion' => 'Jr. Las Flores 567, Huánuco',
                'empleador_id' => 4,
            ],
            [
                'descripcion' => 'Diseño y construcción de un jardín para un espacio de 50m².',
                'fecha_publicacion' => Carbon::now()->subDays(3),
                'estado' => 'pendiente',
                'direccion' => 'Calle Magnolia 45, Huánuco',
                'empleador_id' => 3,
            ],
            [
                'descripcion' => 'Reparación de motor en máquina de coser industrial.',
                'fecha_publicacion' => Carbon::now()->subDays(2),
                'estado' => 'en progreso',
                'direccion' => 'Pasaje Las Torres 89, Huánuco',
                'empleador_id' => 2,
            ],
            [
                'descripcion' => 'Pintura de fachada de local comercial, 20m de altura.',
                'fecha_publicacion' => Carbon::now()->subDays(1),
                'estado' => 'pendiente',
                'direccion' => 'Jr. Independencia 320, Huánuco',
                'empleador_id' => 3,
            ],
            [
                'descripcion' => 'Se requiere un jardinero para la instalación de sistema de riego para un pequeño huerto.',
                'fecha_publicacion' => Carbon::now(),
                'estado' => 'pendiente',
                'direccion' => 'Jr. Progreso 150, Huánuco',
                'empleador_id' => 4,
            ],
        ];

        // Insertar los datos en la base de datos
        foreach ($publicaciones as $publicacion) {
            Publicacion::create($publicacion);
        }
    }
}

