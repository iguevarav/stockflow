<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use App\Models\Proveedor;
use App\Models\Producto;

class OrdenCompraController extends Controller
{
    public function index()
    {
        $ordenes = OrdenCompra::with(['proveedor'])->paginate(10);
        return view('orden_compra.index', compact('ordenes'));
    }

    private function generateOrderNumber()
    {
        $last = OrdenCompra::orderBy('id', 'desc')->first();
        $next = $last ? $last->id + 1 : 1;
        return 'OC-' . str_pad($next, 6, '0', STR_PAD_LEFT);
    }

    public function create()
    {
       
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('orden_compra.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'motivo_compra' => 'required|string|max:255',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_compra' => 'required|numeric|min:0',
        ]);

        $numeroDocumento = $this->generateOrderNumber();

        $subtotal = 0;
        foreach ($request->productos as $item) {
            $subtotal += $item['cantidad'] * $item['precio_compra'];
        }

        $orden = OrdenCompra::create([
            'numero_documento' => $numeroDocumento,
            'proveedor_id' => $request->proveedor_id,
            'fecha_compra' => $request->fecha_compra,
            'motivo_compra' => $request->motivo_compra,
            'subtotal' => $subtotal,
            'estado' => 'pendiente',
        ]);

        foreach ($request->productos as $item) {
            $orden->detalles()->create([
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_compra' => $item['precio_compra'],
                'subtotal' => $item['cantidad'] * $item['precio_compra'],
            ]);
        }

        return redirect()->route('orden_compra.index')->with('success', 'Orden creada correctamente');
    }

    public function setEstado($id )
    {
        $orden = OrdenCompra::findOrFail($id);
        $orden->estado = 'aprobado'; // Cambiar el estado a 'aprobado'
        $orden->save();

        return redirect()->route('orden_compra.index')->with('success', 'Estado de la orden actualizado correctamente.');
    }
        

    public function show($id)
     {
         $orden = OrdenCompra::with(['proveedor', 'detalles.producto'])->findOrFail($id);
         return view('orden_compra.show', compact('orden'));
     }


    public function edit($id)
    {
        $orden = OrdenCompra::with('detalles.producto')->findOrFail($id);
        $proveedores = Proveedor::where('estado', 'ACTIVO')->get();
        $productos = Producto::where('activo', true)->get();

        return view('orden_compra.edit', compact('orden',  'proveedores', 'productos'));
    }

    public function update(Request $request, $id)
    {
        // Validar datos principales
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha_compra' => 'required|date',
            'motivo_compra' => 'required|string|max:255',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio_compra' => 'required|numeric|min:0',
        ]);

        // Buscar orden
        $orden = OrdenCompra::findOrFail($id);

        // Actualizar datos principales
        $orden->proveedor_id = $request->proveedor_id;
        $orden->fecha_compra = $request->fecha_compra;
        $orden->motivo_compra = $request->motivo_compra;

        // Calcular subtotal total
        $subtotal = 0;
        foreach ($request->productos as $producto) {
            $subtotal += $producto['cantidad'] * $producto['precio_compra'];
        }
        $orden->subtotal = $subtotal;

        $orden->save();

        // Actualizar detalles

        // Primero, eliminar detalles existentes para evitar duplicados
        $orden->detalles()->delete();

        // Insertar nuevos detalles
        foreach ($request->productos as $producto) {
            $orden->detalles()->create([
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio_compra' => $producto['precio_compra'],
                'subtotal' => $producto['cantidad'] * $producto['precio_compra'],
            ]);
        }

        return redirect()->route('orden_compra.index')->with('success', 'Orden de compra actualizada correctamente.');
    }

    public function destroy($id)
    {
        $orden = OrdenCompra::findOrFail($id);

        // Eliminar detalles relacionados primero para mantener integridad
        $orden->detalles()->delete();

        // Eliminar la orden
        $orden->delete();

        return redirect()->route('orden_compra.index')->with('success', 'Orden de compra eliminada correctamente.');
    }

    public function buscar(Request $request)
    {
        $query = OrdenCompra::query()->with([ 'proveedor']);

        

        if ($request->filled('proveedor_razon_social')) {
            $razonSocial = $request->proveedor_razon_social;
            $query->whereHas('proveedor', function ($q) use ($razonSocial) {
                $q->where('razon_social', 'like', "%{$razonSocial}%");
            });
        }

        $ordenes = $query->paginate(10);

        return view('orden_compra.index', compact('ordenes'));
    }

    
}
