<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Datos para las estadísticas
            $totalProductos = Producto::count();
            $totalCategorias = Categoria::count();
            $stockBajo = Producto::whereColumn('stock_actual', '<=', 'stock_minimo')->count();
            
            // Calcular valor del inventario
            $valorInventario = Producto::sum(DB::raw('stock_actual * precio_venta'));
            
            // Productos con stock bajo (colección, no conteo)
            $productosStockBajo = Producto::with('categoria')
                ->whereColumn('stock_actual', '<=', 'stock_minimo')
                ->orderBy('stock_actual', 'asc')
                ->take(5)
                ->get();
            
            // Últimos movimientos
            $ultimosMovimientos = collect(); // Colección vacía por defecto
            
            // Solo buscar movimientos si la tabla existe
            if (class_exists('\App\Models\MovimientoInventario')) {
                try {
                    $ultimosMovimientos = MovimientoInventario::with('producto')
                        ->latest()
                        ->take(5)
                        ->get();
                } catch (\Exception $e) {
                    // Si hay error con movimientos, usar colección vacía
                    $ultimosMovimientos = collect();
                }
            }

            return view('dashboard', compact(
                'totalProductos',
                'totalCategorias', 
                'stockBajo',
                'valorInventario',
                'productosStockBajo',
                'ultimosMovimientos'
            ));
            
        } catch (\Exception $e) {
            // En caso de error, usar valores por defecto
            return view('dashboard', [
                'totalProductos' => 0,
                'totalCategorias' => 0,
                'stockBajo' => 0,
                'valorInventario' => 0,
                'productosStockBajo' => collect(),
                'ultimosMovimientos' => collect()
            ]);
        }
    }
}