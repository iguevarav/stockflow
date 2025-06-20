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
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $productosStockBajo = Producto::whereRaw('stock_actual <= stock_minimo')->count();
        $valorInventario = Producto::sum(DB::raw('stock_actual * precio_venta'));
        
       $productosStockBajoLista = Producto::with('categoria')
            ->whereRaw('stock_actual <= stock_minimo')
            ->orderBy('stock_actual', 'asc')
            ->limit(10)
            ->get();
        
        $ultimosMovimientos = MovimientoInventario::with('producto')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard', compact(
            'totalProductos',
            'totalCategorias', 
            'productosStockBajo',
            'valorInventario',
            'productosStockBajoLista',
            'ultimosMovimientos'
        ));
    }
}