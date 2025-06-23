@extends('layouts.app')

@section('title', 'Productos - Sistema de Inventario')
@section('page-title', 'Gestión de Productos')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Productos</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="main-container">
    <!-- Estadísticas superiores -->
    @if($productos->count() > 0)
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-content">
                <h4>{{ $productos->total() }}</h4>
                <p>Total Productos</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h4>{{ \App\Models\Producto::where('activo', true)->count() }}</h4>
                <p>Productos Activos</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h4>{{ \App\Models\Producto::whereRaw('stock_actual <= stock_minimo')->count() }}</h4>
                <p>Stock Bajo</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon value">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <h4>${{ number_format(\App\Models\Producto::sum(\DB::raw('stock_actual * precio_venta')), 0) }}</h4>
                <p>Valor Inventario</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Panel de filtros -->
    <div class="inventory-card">
        <div class="filter-header">
            <h3 class = "text-md" ><i class="fas fa-filter" style="margin-right: 8px;"></i>Filtros de Búsqueda</h3>
        </div>
        <div style="padding: 24px;">
            <form method="GET" action="{{ route('productos.index') }}">
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 16px;">
                        <label for="search" class="form-label-inventory">Búsqueda General</label>
                        <div class="search-input-container">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   class="form-control-inventory search-input" 
                                   id="search" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Nombre, código, descripción o ubicación...">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 16px;">
                        <label for="categoria_id" class="form-label-inventory">Categoría</label>
                        <select class="form-control-inventory" id="categoria_id" name="categoria_id">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                        {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 16px;">
                        <label for="estado" class="form-label-inventory">Estado</label>
                        <select class="form-control-inventory" id="estado" name="estado">
                            <option value="">Todos</option>
                            <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activos</option>
                            <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivos</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 16px;">
                        <label class="form-label-inventory">&nbsp;</label>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="stock_bajo" 
                                       name="stock_bajo" 
                                       value="1"
                                       {{ request('stock_bajo') ? 'checked' : '' }}>
                                <label class="form-check-label" for="stock_bajo" style="font-size: 13px; color: var(--text-secondary);">
                                    Solo stock bajo
                                </label>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="submit" class="btn-inventory btn-primary-inventory">
                                    <i class="fas fa-search" style="margin-right: 4px;"></i> Buscar
                                </button>
                                <a href="{{ route('productos.index') }}" class="btn-inventory btn-light-inventory">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de productos -->
    <div class="inventory-card">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-color); background: white;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--text-primary); margin: 0;">
                        <i class="fas fa-list" style="margin-right: 8px; color: var(--primary-blue);"></i>
                        Lista de Productos
                        @if(request()->hasAny(['search', 'categoria_id', 'estado', 'stock_bajo']))
                            <span class="badge-inventory" style="background: var(--primary-blue); color: var(--white); margin-left: 8px;">
                                {{ $productos->total() }} filtrados
                            </span>
                        @else
                            <span class="badge-inventory" style="background: var(--accent-green); color: var(--white); margin-left: 8px;">
                                {{ $productos->total() }} totales
                            </span>
                        @endif
                    </h3>
                </div>
                <a href="{{ route('productos.create') }}" class="btn-inventory btn-primary-inventory">
                    <i class="fas fa-plus" style="margin-right: 4px;"></i> Nuevo Producto
                </a>
            </div>
        </div>
        <div style="padding: 0;">
            @if($productos->count() > 0)
                <div class="table-responsive">
                    <table class="table-inventory">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Ubicación</th>
                                <th>Stock</th>
                                <th>Precios</th>
                                <th>Estado</th>
                                <th style="text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <div class="product-avatar">
                                            {{ strtoupper(substr($producto->nombre, 0, 2)) }}
                                        </div>
                                        <div class="product-details">
                                            <h5>{{ $producto->nombre }}</h5>
                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                <span class="product-code">{{ $producto->codigo }}</span>
                                                @if($producto->stock_actual <= $producto->stock_minimo)
                                                    <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                @endif
                                            </div>
                                            @if($producto->descripcion)
                                                <p class="product-description">{{ Str::limit($producto->descripcion, 45) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-inventory badge-category">
                                        {{ $producto->categoria->nombre }}
                                    </span>
                                </td>
                                <td>
                                    @if($producto->ubicacion)
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-map-marker-alt" style="color: var(--text-secondary); font-size: 12px; margin-right: 6px;"></i>
                                            <span style="font-size: 13px; color: var(--text-primary); font-weight: 500;">{{ $producto->ubicacion }}</span>
                                        </div>
                                    @else
                                        <span style="color: var(--text-secondary); font-size: 13px; font-style: italic;">Sin ubicación</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="stock-info">
                                        @if($producto->stock_actual <= $producto->stock_minimo)
                                            <span class="badge-inventory badge-stock-danger">{{ $producto->stock_actual }}</span>
                                        @elseif($producto->stock_actual <= ($producto->stock_minimo * 1.5))
                                            <span class="badge-inventory badge-stock-warning">{{ $producto->stock_actual }}</span>
                                        @else
                                            <span class="badge-inventory badge-stock-good">{{ $producto->stock_actual }}</span>
                                        @endif
                                        <div class="stock-min">
                                            Mín: {{ $producto->stock_minimo }} {{ $producto->unidad_medida }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-buy">Compra: ${{ number_format($producto->precio_compra, 2) }}</div>
                                        <div class="price-sell">${{ number_format($producto->precio_venta, 2) }}</div>
                                        @if($producto->precio_venta > 0 && $producto->precio_compra > 0)
                                            <div class="profit-margin">
                                                +{{ number_format((($producto->precio_venta - $producto->precio_compra) / $producto->precio_venta) * 100, 1) }}%
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($producto->activo)
                                        <span class="badge-inventory badge-active">Activo</span>
                                    @else
                                        <span class="badge-inventory badge-inactive">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('productos.show', $producto) }}" 
                                           class="btn-action view" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('productos.edit', $producto) }}" 
                                           class="btn-action edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('movimientos.create', ['producto_id' => $producto->id]) }}" 
                                           class="btn-action move" title="Movimiento">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                        <form action="{{ route('productos.destroy', $producto) }}" 
                                              method="POST" style="display: inline;" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Eliminar">
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
                <div style="display: flex; justify-content: center; padding: 32px;">
                    {{ $productos->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <h4>No hay productos registrados</h4>
                    @if(request()->hasAny(['search', 'categoria_id', 'estado', 'stock_bajo']))
                        <p>No se encontraron productos con los filtros aplicados.</p>
                        <div style="display: flex; justify-content: center; gap: 12px;">
                            <a href="{{ route('productos.index') }}" class="btn-inventory btn-light-inventory">
                                <i class="fas fa-times" style="margin-right: 4px;"></i> Limpiar Filtros
                            </a>
                            <a href="{{ route('productos.create') }}" class="btn-inventory btn-primary-inventory">
                                <i class="fas fa-plus" style="margin-right: 4px;"></i> Crear Producto
                            </a>
                        </div>
                    @else
                        <p>Crea tu primer producto para comenzar a gestionar tu inventario.</p>
                        <a href="{{ route('productos.create') }}" class="btn-inventory btn-primary-inventory" style="padding: 14px 28px; font-size: 15px;">
                            <i class="fas fa-plus" style="margin-right: 8px;"></i> Crear Primer Producto
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection