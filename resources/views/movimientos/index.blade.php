@extends('layouts.app')

@section('title', 'Movimientos de Inventario - Sistema de Inventario')
@section('page-title', 'Movimientos de Inventario')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Movimientos</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section('content')
<div class="movements-container">
    
    <div class="movements-card">
        <div class="filter-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i>
                Filtros de Búsqueda
            </h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('movimientos.index') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="search" class="form-label movements-label">Buscar Producto:</label>
                        <input type="text" 
                               class="form-control movements-input" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Nombre o código del producto">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="producto_id" class="form-label movements-label">Producto Específico:</label>
                        <select class="form-control movements-input" id="producto_id" name="producto_id">
                            <option value="">Todos los productos</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" 
                                        {{ request('producto_id') == $producto->id ? 'selected' : '' }}>
                                    [{{ $producto->codigo }}] {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="tipo_movimiento" class="form-label movements-label">Tipo:</label>
                        <select class="form-control movements-input" id="tipo_movimiento" name="tipo_movimiento">
                            <option value="">Todos</option>
                            <option value="entrada" {{ request('tipo_movimiento') === 'entrada' ? 'selected' : '' }}>Entradas</option>
                            <option value="salida" {{ request('tipo_movimiento') === 'salida' ? 'selected' : '' }}>Salidas</option>
                            <option value="ajuste" {{ request('tipo_movimiento') === 'ajuste' ? 'selected' : '' }}>Ajustes</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="fecha_desde" class="form-label movements-label">Desde:</label>
                        <input type="date" 
                               class="form-control movements-input" 
                               id="fecha_desde" 
                               name="fecha_desde" 
                               value="{{ request('fecha_desde') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="fecha_hasta" class="form-label movements-label">Hasta:</label>
                        <input type="date" 
                               class="form-control movements-input" 
                               id="fecha_hasta" 
                               name="fecha_hasta" 
                               value="{{ request('fecha_hasta') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary movements-btn">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary movements-btn">
                            <i class="fas fa-times"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="movements-card">
        <div class="card-header" style="background: white; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--inventory-border);">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title" style="color: var(--inventory-text); font-weight: 600; margin: 0;">
                    <i class="fas fa-exchange-alt mr-2" style="color: var(--inventory-primary);"></i>
                    Historial de Movimientos
                    @if(request()->hasAny(['search', 'producto_id', 'tipo_movimiento', 'fecha_desde', 'fecha_hasta']))
                        <small class="text-muted">({{ $movimientos->total() }} resultados filtrados)</small>
                    @else
                        <small class="text-muted">({{ $movimientos->total() }} movimientos totales)</small>
                    @endif
                </h3>
                <a href="{{ route('movimientos.create') }}" class="btn btn-success movements-btn">
                    <i class="fas fa-plus"></i> Nuevo Movimiento
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if($movimientos->count() > 0)
                <div class="table-responsive">
                    <table class="movements-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha/Hora</th>
                                <th>Producto</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio Unit.</th>
                                <th class="text-center">Total</th>
                                <th>Motivo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movimientos as $movimiento)
                            <tr>
                                <td>
                                    <span class="movement-id">{{ $movimiento->id }}</span>
                                </td>
                                <td>
                                    <div class="movement-date">{{ $movimiento->created_at->format('d/m/Y') }}</div>
                                    <div class="movement-time">{{ $movimiento->created_at->format('H:i:s') }}</div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <div class="product-avatar">
                                            {{ strtoupper(substr($movimiento->producto->nombre, 0, 2)) }}
                                        </div>
                                        <div class="product-details">
                                            <h6>{{ $movimiento->producto->nombre }}</h6>
                                            <div>
                                                <span class="product-code">{{ $movimiento->producto->codigo }}</span>
                                                <span class="product-category">{{ $movimiento->producto->categoria->nombre }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @switch($movimiento->tipo_movimiento)
                                        @case('entrada')
                                            <span class="movement-badge entrada">
                                                <i class="fas fa-arrow-up"></i> Entrada
                                            </span>
                                            @break
                                        @case('salida')
                                            <span class="movement-badge salida">
                                                <i class="fas fa-arrow-down"></i> Salida
                                            </span>
                                            @break
                                        @case('ajuste')
                                            <span class="movement-badge ajuste">
                                                <i class="fas fa-adjust"></i> Ajuste
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if($movimiento->tipo_movimiento === 'salida')
                                        <div class="quantity-negative">-{{ $movimiento->cantidad }}</div>
                                    @else
                                        <div class="quantity-positive">+{{ $movimiento->cantidad }}</div>
                                    @endif
                                    <div class="quantity-unit">{{ $movimiento->producto->unidad_medida }}</div>
                                </td>
                                <td class="text-center">
                                    @if($movimiento->precio_unitario)
                                        <div class="price-value">${{ number_format($movimiento->precio_unitario, 2) }}</div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($movimiento->precio_unitario)
                                        <div class="price-total">${{ number_format($movimiento->precio_unitario * $movimiento->cantidad, 2) }}</div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="movement-reason">{{ $movimiento->motivo ?? '-' }}</div>
                                    @if($movimiento->observaciones)
                                        <div class="movement-observations">{{ Str::limit($movimiento->observaciones, 30) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('movimientos.show', $movimiento) }}" 
                                           class="btn-action view" title="Ver movimiento">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('productos.show', $movimiento->producto) }}" 
                                           class="btn-action product" title="Ver producto">
                                            <i class="fas fa-box"></i>
                                        </a>
                                        <form action="{{ route('movimientos.destroy', $movimiento) }}" 
                                              method="POST" style="display: inline;" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este movimiento? El stock del producto será ajustado automáticamente.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Eliminar movimiento">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="d-flex justify-content-center p-4">
                    {{ $movimientos->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h5>No hay movimientos registrados</h5>
                    @if(request()->hasAny(['search', 'producto_id', 'tipo_movimiento', 'fecha_desde', 'fecha_hasta']))
                        <p>No se encontraron movimientos con los filtros aplicados.</p>
                        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary movements-btn">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    @else
                        <p>Los movimientos de inventario aparecerán aquí cuando los registres.</p>
                        <a href="{{ route('movimientos.create') }}" class="btn btn-success movements-btn">
                            <i class="fas fa-plus"></i> Registrar Primer Movimiento
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Resumen estadístico -->
    @if($movimientos->count() > 0)
    <div class="row">
        <div class="col-md-3">
            <div class="info-box movements-stat">
                <span class="info-box-icon stat-gradient-info">
                    <i class="fas fa-exchange-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Movimientos</span>
                    <span class="info-box-number">{{ $movimientos->total() }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
