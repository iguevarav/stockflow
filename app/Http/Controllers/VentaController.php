<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Cliente;
use App\Models\Producto;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    private function generateSaleNumber()
    {
        $last = Venta::orderBy('id', 'desc')->first();
        $next = $last ? $last->id + 1 : 1;
        return 'VEN-' . str_pad($next, 6, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'fecha_venta' => 'required|date',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.precio_venta' => 'required|numeric|min:0',
    ]);

    $numeroDocumento = $this->generateSaleNumber();

    $subtotal = 0;
    foreach ($request->productos as $item) {
        $subtotal += $item['cantidad'] * $item['precio_venta'];
    }

    $venta = Venta::create([
        'numero_documento' => $numeroDocumento,
        'cliente_id' => $request->cliente_id,
        'fecha_venta' => $request->fecha_venta,
        'subtotal' => $subtotal, // ✅ Agregado
        'total' => $subtotal,    // ✅ Puedes ajustar si agregas impuestos, etc.
        'estado' => 'pendiente',
    ]);

    foreach ($request->productos as $item) {
        $venta->detalles()->create([
            'producto_id' => $item['producto_id'],
            'cantidad' => $item['cantidad'],
            'precio_venta' => $item['precio_venta'],
            'subtotal' => $item['cantidad'] * $item['precio_venta'],
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
}


    public function show($id)
    {
        $venta = Venta::with(['cliente', 'detalles.producto'])->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();

        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_venta' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio_venta' => 'required|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha_venta = $request->fecha_venta;

        $total = 0;
        foreach ($request->productos as $item) {
            $total += $item['cantidad'] * $item['precio_venta'];
        }
        $venta->subtotal = $total;
        $venta->save();

        $venta->detalles()->delete();

        foreach ($request->productos as $item) {
            $venta->detalles()->create([
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_venta' => $item['precio_venta'],
                'subtotal' => $item['cantidad'] * $item['precio_venta'],
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->detalles()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
    
}
