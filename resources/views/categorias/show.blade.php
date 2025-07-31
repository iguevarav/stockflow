@extends('layouts.app')

@section('title', 'Ver Categoría - Sistema de Inventario')
@section('page-title', 'Detalle de Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
<li class="breadcrumb-item active">{{ $categoria->nombre }}</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section('content')
<div class="detail-container">
    <div class="row">
        <div class="col-md-8">
            <div class="detail-card">
                <div class="detail-header">
                    <h3 class="card-title">
                        <i class="fas fa-tag"></i>
                        {{ $categoria->nombre }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn-tool-edit">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
                <div class="detail-info">
                    <div class="detail-row">
                        <div class="detail-label">Nombre:</div>
                        <div class="detail-value">{{ $categoria->nombre }}</div>
                    </div>
                    <hr class="detail-divider">
                    
                    <div class="detail-row">
                        <div class="detail-label">Descripción:</div>
                        <div class="detail-value">{{ $categoria->descripcion ?? 'Sin descripción' }}</div>
                    </div>
                    <hr class="detail-divider">
                    
                    <div class="detail-row">
                        <div class="detail-label">Total de Productos:</div>
                        <div class="detail-value">
                            <span class="badge badge-info detail-badge">{{ $categoria->productos->count() }} productos</span>
                        </div>
                    </div>
                    <hr class="detail-divider">
                    
                    <div class="detail-row">
                        <div class="detail-label">Fecha de Creación:</div>
                        <div class="detail-value">{{ $categoria->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    <hr class="detail-divider">
                    
                    <div class="detail-row">
                        <div class="detail-label">Última Actualización:</div>
                        <div class="detail-value">{{ $categoria->updated_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Productos de esta categoría -->
            <div class="detail-card">
                <div class="products-header">
                    <h3 class="card-title">
                        <i class="fas fa-boxes"></i>
                        Productos en esta Categoría
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('productos.create', ['categoria' => $categoria->id]) }}" class="btn-tool-add">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($categoria->productos->count() > 0)
                        <div class="table-responsive">
                            <table class="products-table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th class="text-center">Stock Actual</th>
                                        <th class="text-center">Precio Venta</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categoria->productos as $producto)
                                    <tr>
                                        <td>
                                            <code style="background: var(--inventory-light); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                                {{ $producto->codigo }}
                                            </code>
                                        </td>
                                        <td>
                                            <strong>{{ $producto->nombre }}</strong>
                                        </td>
                                        <td class="text-center">
                                            @if($producto->stock_actual <= $producto->stock_minimo)
                                                <span class="badge badge-danger detail-badge">{{ $producto->stock_actual }}</span>
                                            @else
                                                <span class="badge badge-success detail-badge">{{ $producto->stock_actual }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <strong>${{ number_format($producto->precio_venta, 2) }}</strong>
                                        </td>
                                        <td class="text-center">
                                            @if($producto->activo)
                                                <span class="badge badge-success detail-badge">Activo</span>
                                            @else
                                                <span class="badge badge-secondary detail-badge">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <a href="{{ route('productos.show', $producto) }}" 
                                                   class="btn-action view" title="Ver producto">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('productos.edit', $producto) }}" 
                                                   class="btn-action edit" title="Editar producto">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h5>No hay productos en esta categoría</h5>
                            <p>Agrega productos para comenzar a gestionar tu inventario.</p>
                            <a href="{{ route('productos.create', ['categoria' => $categoria->id]) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Primer Producto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="detail-card">
                <div class="actions-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i>
                        Acciones
                    </h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning action-btn">
                        <i class="fas fa-edit"></i> Editar Categoría
                    </a>
                    <a href="{{ route('productos.create', ['categoria' => $categoria->id]) }}" class="btn btn-primary action-btn">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary action-btn">
                        <i class="fas fa-list"></i> Volver a Categorías
                    </a>
                    
                    <hr class="detail-divider">
                    
                    <form action="{{ route('categorias.destroy', $categoria) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger action-btn" 
                                @if($categoria->productos->count() > 0) disabled @endif>
                            <i class="fas fa-trash"></i> Eliminar Categoría
                        </button>
                    </form>
                    
                    @if($categoria->productos->count() > 0)
                        <div class="warning-text">
                            <i class="fas fa-info-circle"></i> 
                            No se puede eliminar porque tiene productos asociados.
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="detail-card">
                <div class="stats-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie"></i>
                        Estadísticas
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mini-info-box">
                        <span class="info-box-icon bg-info mini-gradient">
                            <i class="fas fa-boxes"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Productos</span>
                            <span class="info-box-number">{{ $categoria->productos->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="mini-info-box">
                        <span class="info-box-icon bg-success mini-gradient">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Productos Activos</span>
                            <span class="info-box-number">{{ $categoria->productos->where('activo', true)->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="mini-info-box">
                        <span class="info-box-icon bg-warning mini-gradient">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Stock Bajo</span>
                            <span class="info-box-number">
                                {{ $categoria->productos->filter(function($producto) {
                                    return $producto->stock_actual <= $producto->stock_minimo;
                                })->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection