<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            // Materias Primas
            [
                'codigo' => 'MP001',
                'nombre' => 'Acero Inoxidable 304',
                'descripcion' => 'Lámina de acero inoxidable calibre 18, 1.2mm espesor',
                'categoria_id' => 1,
                'precio_compra' => 8.50,
                'precio_venta' => 12.75,
                'stock_actual' => 2500,
                'stock_minimo' => 500,
                'unidad_medida' => 'kg',
                'activo' => true
            ],
            [
                'codigo' => 'MP002',
                'nombre' => 'Polietileno de Alta Densidad',
                'descripcion' => 'Resina PEAD grado inyección para moldeado',
                'categoria_id' => 1,
                'precio_compra' => 1.85,
                'precio_venta' => 2.40,
                'stock_actual' => 180, // Stock bajo
                'stock_minimo' => 1000,
                'unidad_medida' => 'kg',
                'activo' => true
            ],
            [
                'codigo' => 'MP003',
                'nombre' => 'Aluminio 6061-T6',
                'descripcion' => 'Barra de aluminio extruido para mecanizado',
                'categoria_id' => 1,
                'precio_compra' => 4.20,
                'precio_venta' => 6.30,
                'stock_actual' => 850,
                'stock_minimo' => 200,
                'unidad_medida' => 'kg',
                'activo' => true
            ],
            [
                'codigo' => 'MP004',
                'nombre' => 'Cobre Electrolítico',
                'descripcion' => 'Alambre de cobre puro 99.9% calibre 12 AWG',
                'categoria_id' => 1,
                'precio_compra' => 9.80,
                'precio_venta' => 14.20,
                'stock_actual' => 45, // Stock crítico
                'stock_minimo' => 300,
                'unidad_medida' => 'm',
                'activo' => true
            ],

            // Componentes Electrónicos
            [
                'codigo' => 'CE001',
                'nombre' => 'Microcontrolador PIC32MX',
                'descripcion' => 'MCU 32-bit 80MHz, 512KB Flash, TQFP-100',
                'categoria_id' => 2,
                'precio_compra' => 12.50,
                'precio_venta' => 18.75,
                'stock_actual' => 250,
                'stock_minimo' => 100,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'CE002',
                'nombre' => 'Capacitor Electrolítico 1000µF',
                'descripcion' => 'Capacitor 1000µF 25V radial para fuentes',
                'categoria_id' => 2,
                'precio_compra' => 0.85,
                'precio_venta' => 1.35,
                'stock_actual' => 1200,
                'stock_minimo' => 500,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'CE003',
                'nombre' => 'Resistencia 10kΩ 1/4W',
                'descripcion' => 'Resistencia carbón 10kΩ ±5% 1/4W axial',
                'categoria_id' => 2,
                'precio_compra' => 0.02,
                'precio_venta' => 0.05,
                'stock_actual' => 8500,
                'stock_minimo' => 2000,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'CE004',
                'nombre' => 'PCB Doble Cara FR4',
                'descripcion' => 'Circuito impreso 10x15cm doble cara con máscara',
                'categoria_id' => 2,
                'precio_compra' => 3.20,
                'precio_venta' => 5.80,
                'stock_actual' => 15, // Stock bajo
                'stock_minimo' => 100,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],

            // Materiales de Empaque
            [
                'codigo' => 'EM001',
                'nombre' => 'Caja Corrugada 30x20x15cm',
                'descripcion' => 'Caja kraft corrugado flauta C para envíos',
                'categoria_id' => 3,
                'precio_compra' => 0.45,
                'precio_venta' => 0.75,
                'stock_actual' => 2800,
                'stock_minimo' => 1000,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'EM002',
                'nombre' => 'Etiquetas Código de Barras',
                'descripcion' => 'Etiquetas térmicas 4x2 pulgadas para inventario',
                'categoria_id' => 3,
                'precio_compra' => 0.008,
                'precio_venta' => 0.015,
                'stock_actual' => 15000,
                'stock_minimo' => 5000,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'EM003',
                'nombre' => 'Plástico Burbuja',
                'descripcion' => 'Rollo de plástico burbuja 1.5m x 100m',
                'categoria_id' => 3,
                'precio_compra' => 25.00,
                'precio_venta' => 42.00,
                'stock_actual' => 35,
                'stock_minimo' => 20,
                'unidad_medida' => 'rollo',
                'activo' => true
            ],

            // Productos Semi-terminados
            [
                'codigo' => 'ST001',
                'nombre' => 'Ensamble Motor Paso a Paso',
                'descripcion' => 'Motor paso a paso ensamblado pendiente de calibración',
                'categoria_id' => 4,
                'precio_compra' => 45.00,
                'precio_venta' => 68.00,
                'stock_actual' => 125,
                'stock_minimo' => 50,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'ST002',
                'nombre' => 'Chasis Soldado Sin Pintura',
                'descripcion' => 'Estructura metálica soldada lista para tratamiento',
                'categoria_id' => 4,
                'precio_compra' => 85.00,
                'precio_venta' => 125.00,
                'stock_actual' => 8, // Stock bajo
                'stock_minimo' => 25,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'ST003',
                'nombre' => 'PCB Ensamblado Nivel 1',
                'descripcion' => 'Tarjeta con componentes SMD soldados, falta through-hole',
                'categoria_id' => 4,
                'precio_compra' => 28.50,
                'precio_venta' => 42.75,
                'stock_actual' => 75,
                'stock_minimo' => 30,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],

            // Productos Terminados
            [
                'codigo' => 'PT001',
                'nombre' => 'Controlador Industrial PLC-200',
                'descripcion' => 'PLC para automatización industrial 16 E/S digitales',
                'categoria_id' => 5,
                'precio_compra' => 185.00,
                'precio_venta' => 295.00,
                'stock_actual' => 42,
                'stock_minimo' => 20,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'PT002',
                'nombre' => 'Sensor de Temperatura PT100',
                'descripcion' => 'Sensor industrial -50°C a 400°C con transmisor 4-20mA',
                'categoria_id' => 5,
                'precio_compra' => 95.00,
                'precio_venta' => 155.00,
                'stock_actual' => 3, // Stock crítico
                'stock_minimo' => 15,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'PT003',
                'nombre' => 'Variador de Frecuencia 3HP',
                'descripcion' => 'VFD trifásico 220V para motores hasta 3HP',
                'categoria_id' => 5,
                'precio_compra' => 320.00,
                'precio_venta' => 485.00,
                'stock_actual' => 18,
                'stock_minimo' => 8,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],

            // Herramientas y Equipos
            [
                'codigo' => 'HE001',
                'nombre' => 'Torno CNC Inserto Carburo',
                'descripcion' => 'Inserto de carburo TNMG 160408 para torneado',
                'categoria_id' => 6,
                'precio_compra' => 8.50,
                'precio_venta' => 15.20,
                'stock_actual' => 240,
                'stock_minimo' => 100,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'HE002',
                'nombre' => 'Broca HSS 12mm',
                'descripcion' => 'Broca helicoidal acero rápido para taladro industrial',
                'categoria_id' => 6,
                'precio_compra' => 15.80,
                'precio_venta' => 28.50,
                'stock_actual' => 6, // Stock bajo
                'stock_minimo' => 20,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],
            [
                'codigo' => 'HE003',
                'nombre' => 'Calibrador Vernier Digital',
                'descripcion' => 'Calibrador digital 0-150mm precisión 0.01mm',
                'categoria_id' => 6,
                'precio_compra' => 45.00,
                'precio_venta' => 75.00,
                'stock_actual' => 12,
                'stock_minimo' => 5,
                'unidad_medida' => 'unidad',
                'activo' => true
            ],

            // Químicos y Lubricantes
            [
                'codigo' => 'QL001',
                'nombre' => 'Aceite Hidráulico ISO 46',
                'descripcion' => 'Aceite hidráulico para sistemas industriales',
                'categoria_id' => 7,
                'precio_compra' => 8.50,
                'precio_venta' => 14.25,
                'stock_actual' => 185,
                'stock_minimo' => 100,
                'unidad_medida' => 'l',
                'activo' => true
            ],
            [
                'codigo' => 'QL002',
                'nombre' => 'Desengrasante Industrial',
                'descripcion' => 'Solvente para limpieza de piezas metálicas',
                'categoria_id' => 7,
                'precio_compra' => 12.00,
                'precio_venta' => 22.00,
                'stock_actual' => 25, // Stock bajo
                'stock_minimo' => 50,
                'unidad_medida' => 'l',
                'activo' => true
            ],
            [
                'codigo' => 'QL003',
                'nombre' => 'Grasa Litio EP2',
                'descripcion' => 'Grasa multiuso para rodamientos y engranajes',
                'categoria_id' => 7,
                'precio_compra' => 4.80,
                'precio_venta' => 8.50,
                'stock_actual' => 95,
                'stock_minimo' => 30,
                'unidad_medida' => 'kg',
                'activo' => true
            ],
            [
                'codigo' => 'QL004',
                'nombre' => 'Flux para Soldadura',
                'descripcion' => 'Pasta flux para soldadura de componentes electrónicos',
                'categoria_id' => 7,
                'precio_compra' => 18.50,
                'precio_venta' => 32.00,
                'stock_actual' => 4, // Stock crítico
                'stock_minimo' => 15,
                'unidad_medida' => 'kg',
                'activo' => true
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}