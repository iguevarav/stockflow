<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Materias Primas',
                'descripcion' => 'Materiales básicos para producción'
            ],
            [
                'nombre' => 'Componentes Electrónicos',
                'descripcion' => 'Circuitos, chips, resistencias y componentes electrónicos'
            ],
            [
                'nombre' => 'Materiales de Empaque',
                'descripcion' => 'Cajas, etiquetas, plásticos y materiales de embalaje'
            ],
            [
                'nombre' => 'Productos Semi-terminados',
                'descripcion' => 'Productos en proceso de fabricación'
            ],
            [
                'nombre' => 'Productos Terminados',
                'descripcion' => 'Productos listos para distribución'
            ],
            [
                'nombre' => 'Herramientas y Equipos',
                'descripcion' => 'Herramientas de producción y mantenimiento'
            ],
            [
                'nombre' => 'Químicos y Lubricantes',
                'descripcion' => 'Productos químicos para procesos industriales'
            ]
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}