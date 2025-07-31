@extends('layouts.app')

@section('title', 'Ver Movimiento - Sistema de Inventario')
@section('page-title', 'Detalle del Movimiento')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('movimientos.index') }}">Movimientos</a></li>
<li class="breadcrumb-item active">Movimiento #{{ $movimiento->id }}</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section('content')
<div class="movement-detail-container">
    <div class="row">
        <div class="col-md-8">
            <!-- Información del Movimiento -->
            <div class="movement-detail-card">
                <div class="movement-detail-header">
                    <h3 class="card-title">
                        <i class="fas fa-exchange-alt"></i>
                        Movimiento #{{ $movimiento->id }}
                        @switch($movimiento->tipo_movimiento)
                            @case('entrada')
                                <span class="badge badge-success movement-detail-badge ml-2">
                                    <i class="fas fa-arrow-up"></i> Entrada
                                </span>
                                @break
                            @case('salida')
                                <span class="badge badge-danger movement-detail-badge ml-2">
                                    <i class="fas fa-arrow-down"></i> Salida
                                </span>
                                @break
                            @case('ajuste')
                                <span class="badge badge-warning movement-detail-badge ml-2">
                                    <i class="fas fa-adjust"></i> Ajuste
                                </span>
                                @break
                        @endswitch
                    </h3>
                </div>
                <div class="card-body">
                    <div class="movement-info-row">
                        <div class="movement-info-label">ID del Movimiento:</div>
                        <div class="movement-info-value">{{ $movimiento->id }}</div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Fecha y Hora:</div>
                        <div class="movement-info-value">
                            {{ $movimiento->created_at->format('d/m/Y H:i:s') }}
                            <small class="text-muted d-block">({{ $movimiento->created_at->diffForHumans() }})</small>
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Producto:</div>
                        <div class="movement-info-value">
                            <a href="{{ route('productos.show', $movimiento->producto) }}" class="product-link">
                                <strong>{{ $movimiento->producto->nombre }}</strong>
                            </a>
                            <div class="mt-1">
                                <small class="text-muted">
                                    Código: <span class="product-code">{{ $movimiento->producto->codigo }}</span> | 
                                    Categoría: {{ $movimiento->producto->categoria->nombre }}
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Tipo de Movimiento:</div>
                        <div class="movement-info-value">
                            @switch($movimiento->tipo_movimiento)
                                @case('entrada')
                                    <span class="badge badge-success movement-detail-badge badge-lg">
                                        <i class="fas fa-arrow-up"></i> Entrada de Inventario
                                    </span>
                                    <div class="mt-1"><small class="text-muted">Se agregó stock al producto</small></div>
                                    @break
                                @case('salida')
                                    <span class="badge badge-danger movement-detail-badge badge-lg">
                                        <i class="fas fa-arrow-down"></i> Salida de Inventario
                                    </span>
                                    <div class="mt-1"><small class="text-muted">Se redujo stock del producto</small></div>
                                    @break
                                @case('ajuste')
                                    <span class="badge badge-warning movement-detail-badge badge-lg">
                                        <i class="fas fa-adjust"></i> Ajuste de Inventario
                                    </span>
                                    <div class="mt-1"><small class="text-muted">Se corrigió el stock del producto</small></div>
                                    @break
                            @endswitch
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Cantidad:</div>
                        <div class="movement-info-value">
                            @if($movimiento->tipo_movimiento === 'salida')
                                <span class="badge badge-danger movement-detail-badge badge-lg">-{{ $movimiento->cantidad }}</span>
                            @else
                                <span class="badge badge-success movement-detail-badge badge-lg">+{{ $movimiento->cantidad }}</span>
                            @endif
                            {{ $movimiento->producto->unidad_medida }}
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Precio Unitario:</div>
                        <div class="movement-info-value">
                            @if($movimiento->precio_unitario)
                                <span class="price-display">${{ number_format($movimiento->precio_unitario, 2) }}</span>
                            @else
                                <span class="text-muted">No especificado</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Valor Total:</div>
                        <div class="movement-info-value">
                            @if($movimiento->precio_unitario)
                                <span class="price-display text-primary">${{ number_format($movimiento->precio_unitario * $movimiento->cantidad, 2) }}</span>
                            @else
                                <span class="text-muted">No calculado</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Motivo:</div>
                        <div class="movement-info-value">{{ $movimiento->motivo ?? 'Sin motivo especificado' }}</div>
                    </div>
                    
                    <div class="movement-info-row">
                        <div class="movement-info-label">Observaciones:</div>
                        <div class="movement-info-value">
                            @if($movimiento->observaciones)
                                <div class="observaciones-box">
                                    {{ $movimiento->observaciones }}
                                </div>
                            @else
                                <span class="text-muted">Sin observaciones</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Estado actual del producto -->
            <div class="movement-detail-card">
                <div class="product-status-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Estado Actual del Producto
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="movement-info-box">
                                <span class="movement-info-box-icon bg-info"><i class="fas fa-cubes"></i></span>
                                <div class="movement-info-box-content">
                                    <div class="movement-info-box-text">Stock Actual</div>
                                    <div class="movement-info-box-number">{{ $movimiento->producto->stock_actual }}</div>
                                    <div class="movement-info-box-more">{{ $movimiento->producto->unidad_medida }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="movement-info-box">
                                <span class="movement-info-box-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></span>
                                <div class="movement-info-box-content">
                                    <div class="movement-info-box-text">Stock Mínimo</div>
                                    <div class="movement-info-box-number">{{ $movimiento->producto->stock_minimo }}</div>
                                    <div class="movement-info-box-more">{{ $movimiento->producto->unidad_medida }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="movement-info-box">
                                <span class="movement-info-box-icon 
                                    @if($movimiento->producto->stock_actual <= $movimiento->producto->stock_minimo) 
                                        bg-danger
                                    @elseif($movimiento->producto->stock_actual <= ($movimiento->producto->stock_minimo * 1.5)) 
                                        bg-warning
                                    @else 
                                        bg-success
                                    @endif">
                                    <i class="fas fa-chart-bar"></i>
                                </span>
                                <div class="movement-info-box-content">
                                    <div class="movement-info-box-text">Estado</div>
                                    <div class="movement-info-box-number">
                                        @if($movimiento->producto->stock_actual <= $movimiento->producto->stock_minimo)
                                            <small class="text-danger font-weight-bold">Stock Bajo</small>
                                        @elseif($movimiento->producto->stock_actual <= ($movimiento->producto->stock_minimo * 1.5))
                                            <small class="text-warning font-weight-bold">Stock Medio</small>
                                        @else
                                            <small class="text-success font-weight-bold">Stock OK</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Acciones -->
            <div class="movement-detail-card">
                <div class="actions-movement-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i>
                        Acciones
                    </h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('productos.show', $movimiento->producto) }}" class="btn btn-info movement-detail-btn">
                        <i class="fas fa-box"></i> Ver Producto
                    </a>
                    <a href="{{ route('movimientos.create', ['producto_id' => $movimiento->producto->id]) }}" class="btn btn-success movement-detail-btn">
                        <i class="fas fa-plus"></i> Nuevo Movimiento
                    </a>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-secondary movement-detail-btn">
                        <i class="fas fa-list"></i> Volver a Movimientos
                    </a>
                    
                    <hr class="section-divider">
                    
                    <form action="{{ route('movimientos.destroy', $movimiento) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este movimiento? El stock del producto será ajustado automáticamente.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger movement-detail-btn">
                            <i class="fas fa-trash"></i> Eliminar Movimiento
                        </button>
                    </form>
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Al eliminar, el stock se ajustará automáticamente.
                    </small>
                </div>
            </div>
            
            <!-- Información del Sistema -->
            <div class="movement-detail-card">
                <div class="system-info-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Información del Sistema
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table system-info-table">
                        <tr>
                            <th>ID:</th>
                            <td>{{ $movimiento->id }}</td>
                        </tr>
                        <tr>
                            <th>Creado:</th>
                            <td>{{ $movimiento->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Actualizado:</th>
                            <td>{{ $movimiento->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                <div class="card-body">
                    @php
                        $ultimosMovimientos = $movimiento->producto->movimientos()
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($ultimosMovimientos->count() > 0)
                        <div class="movement-timeline">
                            @foreach($ultimosMovimientos as $mov)
                                <div class="timeline-item {{ $mov->id === $movimiento->id ? 'bg-primary' : '' }}">
                                    <span class="time text-black">
                                        <i class="fas fa-clock"></i> {{ $mov->created_at->format('d/m H:i') }}
                                    </span>
                                    <h3 class="timeline-header text-black">
                                        @switch($mov->tipo_movimiento)
                                            @case('entrada')
                                                <span class="badge badge-success movement-detail-badge">Entrada</span>
                                                @break
                                            @case('salida')
                                                <span class="badge badge-danger movement-detail-badge">Salida</span>
                                                @break
                                            @case('ajuste')
                                                <span class="badge badge-warning movement-detail-badge">Ajuste</span>
                                                @break
                                        @endswitch
                                        <span>{{ $mov->cantidad }} {{ $mov->producto->unidad_medida }}</span>
                                        @if($mov->id === $movimiento->id)
                                            <small class="text-primary font-weight-bold">(Actual)</small>
                                        @endif
                                    </h3>
                                    <div class="timeline-body text-black">
                                        {{ $mov->motivo ?? 'Sin motivo' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No hay movimientos adicionales para este producto.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection