@extends('layouts.app')

@section('title', 'Ver Producto - Sistema de Inventario')
@section('page-title', 'Detalle del Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">{{ $producto->nombre }}</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="product-detail-container">
    <div class="row">
        <div class="col-md-8">
            <!-- Información del Producto -->
            <div class="product-detail-card">
                <div class="detail-header">
                    <h3 class="card-title">
                        <div>
                            <i class="fas fa-box"></i>
                            {{ $producto->nombre }}
                            @if(!$producto->activo)
                                <span class="badge badge-secondary inventory-badge ml-2">Inactivo</span>
                            @endif
                            @if($producto->stock_actual <= $producto->stock_minimo)
                                <span class="badge badge-warning inventory-badge ml-2">Stock Bajo</span>
                            @endif
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="product-info-row">
                        <div class="product-info-label">Código:</div>
                        <div class="product-info-value">
                            <span class="product-code">{{ $producto->codigo }}</span>
                        </div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Nombre:</div>
                        <div class="product-info-value">{{ $producto->nombre }}</div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Descripción:</div>
                        <div class="product-info-value">{{ $producto->descripcion ?? 'Sin descripción' }}</div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Categoría:</div>
                        <div class="product-info-value">
                            <a href="{{ route('categorias.show', $producto->categoria) }}" class="badge badge-info inventory-badge">
                                {{ $producto->categoria->nombre }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Stock Actual:</div>
                        <div class="product-info-value">
                            @if($producto->stock_actual <= $producto->stock_minimo)
                                <span class="badge badge-danger inventory-badge">{{ $producto->stock_actual }}</span>
                            @elseif($producto->stock_actual <= ($producto->stock_minimo * 1.5))
                                <span class="badge badge-warning inventory-badge">{{ $producto->stock_actual }}</span>
                            @else
                                <span class="badge badge-success inventory-badge">{{ $producto->stock_actual }}</span>
                            @endif
                            {{ $producto->unidad_medida }}
                            <small class="text-muted">(Mínimo: {{ $producto->stock_minimo }})</small>
                        </div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Precios:</div>
                        <div class="product-info-value">
                            <div class="price-display">
                                <strong>Compra:</strong> ${{ number_format($producto->precio_compra, 2) }}<br>
                                <strong>Venta:</strong> ${{ number_format($producto->precio_venta, 2) }}
                            </div>
                            @if($producto->precio_venta > 0 && $producto->precio_compra > 0)
                                <div class="margin-info">
                                    <i class="fas fa-calculator"></i>
                                    Margen: {{ number_format((($producto->precio_venta - $producto->precio_compra) / $producto->precio_venta) * 100, 1) }}%
                                    (Ganancia: ${{ number_format($producto->precio_venta - $producto->precio_compra, 2) }})
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Estado:</div>
                        <div class="product-info-value">
                            @if($producto->activo)
                                <span class="badge badge-success inventory-badge">Activo</span>
                            @else
                                <span class="badge badge-secondary inventory-badge">Inactivo</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="product-info-row">
                        <div class="product-info-label">Fechas:</div>
                        <div class="product-info-value">
                            <strong>Creado:</strong> {{ $producto->created_at->format('d/m/Y H:i:s') }}<br>
                            <strong>Actualizado:</strong> {{ $producto->updated_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Historial de Movimientos -->
            <div class="product-detail-card">
                <div class="history-header">
                    <h3 class="card-title">
                        <div>
                            <i class="fas fa-history"></i>
                            Historial de Movimientos
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    @if($producto->movimientos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm movements-table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unit.</th>
                                        <th>Motivo</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($producto->movimientos->sortByDesc('created_at') as $movimiento)
                                    <tr>
                                        <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @switch($movimiento->tipo_movimiento)
                                                @case('entrada')
                                                    <span class="badge badge-success inventory-badge">
                                                        <i class="fas fa-arrow-up"></i> Entrada
                                                    </span>
                                                    @break
                                                @case('salida')
                                                    <span class="badge badge-danger inventory-badge">
                                                        <i class="fas fa-arrow-down"></i> Salida
                                                    </span>
                                                    @break
                                                @case('ajuste')
                                                    <span class="badge badge-warning inventory-badge">
                                                        <i class="fas fa-adjust"></i> Ajuste
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($movimiento->tipo_movimiento === 'salida')
                                                <span class="text-danger font-weight-bold">-{{ $movimiento->cantidad }}</span>
                                            @else
                                                <span class="text-success font-weight-bold">+{{ $movimiento->cantidad }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($movimiento->precio_unitario)
                                                <span class="price-display">${{ number_format($movimiento->precio_unitario, 2) }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $movimiento->motivo ?? '-' }}</td>
                                        <td>{{ Str::limit($movimiento->observaciones, 30) ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="no-movements">
                            <i class="fas fa-history"></i>
                            <h5>No hay movimientos registrados</h5>
                            <p>Los movimientos de inventario aparecerán aquí.</p>
                            <a href="{{ route('movimientos.create', ['producto_id' => $producto->id]) }}" class="btn btn-success inventory-btn" style="max-width: 300px; margin: 0 auto;">
                                <i class="fas fa-plus"></i> Registrar Primer Movimiento
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Estadísticas del Producto -->
            <div class="product-detail-card">
                <div class="stats-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        Estadísticas
                    </h3>
                </div>
                <div class="card-body">
                    <div class="inventory-info-box">
                        <span class="inventory-info-box-icon bg-primary"><i class="fas fa-cubes"></i></span>
                        <div class="inventory-info-box-content">
                            <div class="inventory-info-box-text">Stock Actual</div>
                            <div class="inventory-info-box-number">{{ $producto->stock_actual }}</div>
                            <div class="inventory-info-box-more">{{ $producto->unidad_medida }}</div>
                        </div>
                    </div>
                    
                    <div class="inventory-info-box">
                        <span class="inventory-info-box-icon bg-success"><i class="fas fa-arrow-up"></i></span>
                        <div class="inventory-info-box-content">
                            <div class="inventory-info-box-text">Total Entradas</div>
                            <div class="inventory-info-box-number">
                                {{ $producto->movimientos->where('tipo_movimiento', 'entrada')->sum('cantidad') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="inventory-info-box">
                        <span class="inventory-info-box-icon bg-danger"><i class="fas fa-arrow-down"></i></span>
                        <div class="inventory-info-box-content">
                            <div class="inventory-info-box-text">Total Salidas</div>
                            <div class="inventory-info-box-number">
                                {{ $producto->movimientos->where('tipo_movimiento', 'salida')->sum('cantidad') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="inventory-info-box">
                        <span class="inventory-info-box-icon bg-warning"><i class="fas fa-exchange-alt"></i></span>
                        <div class="inventory-info-box-content">
                            <div class="inventory-info-box-text">Movimientos</div>
                            <div class="inventory-info-box-number">{{ $producto->movimientos->count() }}</div>
                        </div>
                    </div>
                    
                    @if($producto->stock_actual > 0 && $producto->precio_venta > 0)
                    <div class="inventory-info-box">
                        <span class="inventory-info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                        <div class="inventory-info-box-content">
                            <div class="inventory-info-box-text">Valor en Stock</div>
                            <div class="inventory-info-box-number">${{ number_format($producto->stock_actual * $producto->precio_venta, 2) }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Acciones -->
            <div class="product-detail-card">
                <div class="actions-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i>
                        Acciones
                    </h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning inventory-btn">
                        <i class="fas fa-edit"></i> Editar Producto
                    </a>
                    <a href="{{ route('movimientos.create', ['producto_id' => $producto->id]) }}" class="btn btn-success inventory-btn">
                        <i class="fas fa-plus"></i> Nuevo Movimiento
                    </a>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary inventory-btn">
                        <i class="fas fa-list"></i> Volver a Productos
                    </a>
                    
                    <hr class="section-divider">
                    
                    <form action="{{ route('productos.destroy', $producto) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger inventory-btn" 
                                @if($producto->movimientos->count() > 0) disabled title="No se puede eliminar porque tiene movimientos asociados" @endif>
                            <i class="fas fa-trash"></i> Eliminar Producto
                        </button>
                    </form>
                    @if($producto->movimientos->count() > 0)
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> 
                            No se puede eliminar porque tiene movimientos asociados.
                        </small>
                    @endif
                </div>
            </div>
            
            <!-- Alertas -->
            @if($producto->stock_actual <= $producto->stock_minimo)
            <div class="product-detail-card">
                <div class="alert-header">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alerta de Stock
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-danger font-weight-bold">
                        <strong>¡Stock bajo!</strong> 
                        El stock actual ({{ $producto->stock_actual }}) está por debajo o igual al mínimo establecido ({{ $producto->stock_minimo }}).
                    </p>
                    <a href="{{ route('movimientos.create', ['producto_id' => $producto->id, 'tipo' => 'entrada']) }}" 
                       class="btn btn-warning inventory-btn">
                        <i class="fas fa-plus"></i> Reabastecer Stock
                    </a>
                </div>
            </div>
            @endif
            
            @if(!$producto->activo)
            <div class="product-detail-card">
                <div class="inactive-header">
                    <h3 class="card-title">
                        <i class="fas fa-pause-circle"></i>
                        Producto Inactivo
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Este producto está marcado como inactivo y no aparecerá en las ventas.
                    </p>
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-secondary inventory-btn">
                        <i class="fas fa-edit"></i> Activar Producto
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection