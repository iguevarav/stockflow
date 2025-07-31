<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    protected $table = 'orden_compra_detalle';
    protected $fillable = ['orden_compra_id', 'producto_id', 'cantidad', 'precio_compra', 'subtotal'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function ordenCompra()
    {
        return $this->belongsTo(OrdenCompra::class, 'orden_compra_id');
    }
}
