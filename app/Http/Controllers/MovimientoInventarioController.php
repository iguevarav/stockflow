<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoInventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = MovimientoInventario::with('producto.categoria');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('producto', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('codigo', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('producto_id')) {
            $query->where('producto_id', $request->producto_id);
        }
        
        if ($request->filled('tipo_movimiento')) {
            $query->where('tipo_movimiento', $request->tipo_movimiento);
        }
        
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        $movimientos = $query->orderBy('created_at', 'desc')->paginate(15);
        $productos = Producto::orderBy('nombre')->get();
        
        return view('movimientos.index', compact('movimientos', 'productos'));
    }

    public function create(Request $request)
    {
        $productos = Producto::where('activo', true)->orderBy('nombre')->get();
        $producto_seleccionado = null;
        
        if ($request->filled('producto_id')) {
            $producto_seleccionado = Producto::find($request->producto_id);
        }
        
        return view('movimientos.create', compact('productos', 'producto_seleccionado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo_movimiento' => 'required|in:entrada,salida,ajuste',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'nullable|numeric|min:0',
            'motivo' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            $producto = Producto::findOrFail($request->producto_id);
            
            if ($request->tipo_movimiento === 'salida' && $request->cantidad > $producto->stock_actual) {
                return back()->withErrors([
                    'cantidad' => 'No puedes sacar más cantidad de la disponible en stock (' . $producto->stock_actual . ')'
                ])->withInput();
            }
            
            MovimientoInventario::create($request->all());
            
            switch ($request->tipo_movimiento) {
                case 'entrada':
                    $producto->increment('stock_actual', $request->cantidad);
                    break;
                case 'salida':
                    $producto->decrement('stock_actual', $request->cantidad);
                    break;
                case 'ajuste':
                    // Para ajustes, la cantidad representa el nuevo stock total
                    $diferencia = $request->cantidad - $producto->stock_actual;
                    $producto->update(['stock_actual' => $request->cantidad]);
                    
                    // Actualizar el movimiento para reflejar la diferencia
                    $movimiento = MovimientoInventario::latest()->first();
                    $movimiento->update(['cantidad' => abs($diferencia)]);
                    
                    if ($diferencia < 0) {
                        $movimiento->update(['tipo_movimiento' => 'salida']);
                    }
                    break;
            }
            
            DB::commit();
            
            return redirect()->route('movimientos.index')
                ->with('success', 'Movimiento de inventario registrado exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error al procesar el movimiento: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function show(MovimientoInventario $movimiento)
    {
        $movimiento->load('producto.categoria');
        return view('movimientos.show', compact('movimiento'));
    }

    public function edit(MovimientoInventario $movimiento)
    {

        return redirect()->route('movimientos.index')
            ->with('error', 'Los movimientos de inventario no se pueden editar por razones de auditoría.');
    }

    public function update(Request $request, MovimientoInventario $movimiento)
    {
        return redirect()->route('movimientos.index')
            ->with('error', 'Los movimientos de inventario no se pueden modificar por razones de auditoría.');
    }

    public function destroy(MovimientoInventario $movimiento)
    {
        try {
            DB::beginTransaction();
            
            $producto = $movimiento->producto;
            
            switch ($movimiento->tipo_movimiento) {
                case 'entrada':
                    // Si fue entrada, restar del stock actual
                    if ($producto->stock_actual >= $movimiento->cantidad) {
                        $producto->decrement('stock_actual', $movimiento->cantidad);
                    } else {
                        throw new \Exception('No se puede eliminar: el stock actual es menor que la cantidad del movimiento.');
                    }
                    break;
                case 'salida':
                    // Si fue salida, sumar al stock actual
                    $producto->increment('stock_actual', $movimiento->cantidad);
                    break;
                case 'ajuste':
                    throw new \Exception('No se pueden eliminar movimientos de ajuste. Cree un nuevo ajuste si es necesario.');
                    break;
            }
            
            $movimiento->delete();
            
            DB::commit();
            
            return redirect()->route('movimientos.index')
                ->with('success', 'Movimiento eliminado y stock actualizado correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('movimientos.index')
                ->with('error', 'Error al eliminar el movimiento: ' . $e->getMessage());
        }
    }
}