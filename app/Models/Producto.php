<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'categoria_id',
        'precio_compra', 'precio_venta', 'stock_actual',
        'stock_minimo', 'unidad_medida','ubicacion', 'activo'
    ];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function movimientos()
    {
        return $this->hasMany(MovimientoInventario::class);
    }
}
