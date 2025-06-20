@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Inventario')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="main-container">
    <!-- Estadísticas superiores -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-content">
                <h4>{{ $totalProductos ?? 24 }}</h4>
                <p>Total Productos</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <h4>{{ $totalCategorias ?? 7 }}</h4>
                <p>Categorías</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h4>{{ $stockBajo ?? 8 }}</h4>
                <p>Stock Bajo</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon value">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <h4>${{ number_format($valorInventario ?? 92122.50, 2) }}</h4>
                <p>Valor Inventario</p>
            </div>
        </div>
    </div>

    <!-- Grid de contenido principal -->
    <div class="dashboard-grid">
        <!-- Panel de productos con stock bajo -->
        <div class="dashboard-panel products-panel">
            <div class="panel-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Productos con Stock Bajo</h3>
            </div>
            <div class="panel-content">
                @if(isset($productosStockBajo) && $productosStockBajo->count() > 0)
                    @foreach($productosStockBajo as $producto)
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>{{ $producto->nombre }}</h5>
                            <span class="category-badge">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                @php
                                    $porcentaje = $producto->stock_minimo > 0 ? ($producto->stock_actual / $producto->stock_minimo * 100) : 0;
                                    $porcentaje = min($porcentaje, 100); // Máximo 100%
                                @endphp
                                <div class="stock-fill" style="width: {{ $porcentaje }}%"></div>
                            </div>
                            <span class="stock-numbers">{{ $producto->stock_actual }}/{{ $producto->stock_minimo }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Datos de ejemplo -->
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>Sensor de Temperatura PT100</h5>
                            <span class="category-badge">Productos Terminados</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                <div class="stock-fill" style="width: 20%"></div>
                            </div>
                            <span class="stock-numbers">3/15</span>
                        </div>
                    </div>
                    
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>Flux para Soldadura</h5>
                            <span class="category-badge">Químicos y Lubricantes</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                <div class="stock-fill" style="width: 27%"></div>
                            </div>
                            <span class="stock-numbers">4/15</span>
                        </div>
                    </div>
                    
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>Broca HSS 12mm</h5>
                            <span class="category-badge">Herramientas y Equipos</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                <div class="stock-fill" style="width: 30%"></div>
                            </div>
                            <span class="stock-numbers">6/20</span>
                        </div>
                    </div>
                    
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>Chasis Soldado Sin Pintura</h5>
                            <span class="category-badge">Productos Semi-terminados</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                <div class="stock-fill" style="width: 32%"></div>
                            </div>
                            <span class="stock-numbers">8/25</span>
                        </div>
                    </div>
                    
                    <div class="stock-item">
                        <div class="stock-product-info">
                            <h5>PCB Doble Cara FR4</h5>
                            <span class="category-badge">Componentes Electrónicos</span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar">
                                <div class="stock-fill" style="width: 15%"></div>
                            </div>
                            <span class="stock-numbers">15/100</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Panel de últimos movimientos -->
        <div class="dashboard-panel movements-panel">
            <div class="panel-header">
                <h3><i class="fas fa-exchange-alt"></i> Últimos Movimientos</h3>
            </div>
            <div class="panel-content">
                @if(isset($ultimosMovimientos) && $ultimosMovimientos->count() > 0)
                    @foreach($ultimosMovimientos as $movimiento)
                    <div class="movement-item">
                        <div class="movement-icon {{ $movimiento->tipo == 'entrada' ? 'entrada' : 'salida' }}">
                            <i class="fas fa-{{ $movimiento->tipo == 'entrada' ? 'arrow-down' : 'arrow-up' }}"></i>
                        </div>
                        <div class="movement-info">
                            <h5>{{ $movimiento->producto->nombre ?? 'Producto' }}</h5>
                            <p>{{ ucfirst($movimiento->tipo) }} de {{ $movimiento->cantidad }} unidades</p>
                            <span class="movement-date">{{ $movimiento->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Estado vacío -->
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <p>No hay movimientos recientes</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Panel de acciones rápidas -->
    <div class="quick-actions-panel">
        <div class="panel-header">
            <h3><i class="fas fa-bolt"></i> Acciones Rápidas</h3>
        </div>
        <div class="quick-actions-grid">
            <a href="{{ route('productos.create') }}" class="quick-action-card">
                <div class="action-icon add">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-content">
                    <h4>Nuevo Producto</h4>
                    <p>Agregar producto al inventario</p>
                </div>
            </a>
            
            <a href="{{ route('movimientos.create') }}" class="quick-action-card">
                <div class="action-icon move">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="action-content">
                    <h4>Registrar Movimiento</h4>
                    <p>Entrada o salida de stock</p>
                </div>
            </a>
            
            <a href="{{ route('categorias.create') }}" class="quick-action-card">
                <div class="action-icon category">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="action-content">
                    <h4>Nueva Categoría</h4>
                    <p>Crear categoría de productos</p>
                </div>
            </a>
            
            <a href="{{ route('productos.index', ['stock_bajo' => 1]) }}" class="quick-action-card">
                <div class="action-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="action-content">
                    <h4>Stock Bajo</h4>
                    <p>Ver productos con stock bajo</p>
                </div>
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Estilos específicos del dashboard */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.dashboard-panel {
    background: var(--white);
    border-radius: 12px;
    box-shadow: 0 2px 15px var(--shadow-light);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: all 0.3s ease;
}

.dashboard-panel:hover {
    box-shadow: 0 4px 20px var(--shadow-medium);
}

.panel-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
    color: white;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.panel-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.panel-content {
    padding: 1.5rem;
    max-height: 400px;
    overflow-y: auto;
}

/* Productos con stock bajo */
.stock-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.stock-item:last-child {
    border-bottom: none;
}

.stock-product-info h5 {
    margin: 0 0 0.25rem 0;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-primary);
}

.category-badge {
    background: #e3f2fd;
    color: #1565c0;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.stock-indicator {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.25rem;
    min-width: 120px;
}

.stock-bar {
    width: 100px;
    height: 6px;
    background: #f0f0f0;
    border-radius: 3px;
    overflow: hidden;
}

.stock-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--danger-red) 0%, var(--warning-orange) 50%, var(--accent-green) 100%);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.stock-numbers {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-secondary);
}

/* Últimos movimientos */
.movement-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.movement-item:last-child {
    border-bottom: none;
}

.movement-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.movement-icon.entrada {
    background: linear-gradient(135deg, var(--accent-green) 0%, #2ecc71 100%);
}

.movement-icon.salida {
    background: linear-gradient(135deg, var(--danger-red) 0%, #e74c3c 100%);
}

.movement-info h5 {
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-primary);
}

.movement-info p {
    margin: 0 0 0.25rem 0;
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.movement-date {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* Estado vacío */
.empty-state {
    text-align: center;
    padding: 2rem 1rem;
}

.empty-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

/* Panel de acciones rápidas */
.quick-actions-panel {
    background: var(--white);
    border-radius: 12px;
    box-shadow: 0 2px 15px var(--shadow-light);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    padding: 1.5rem;
}

.quick-action-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.quick-action-card:hover {
    border-color: var(--primary-blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px var(--shadow-medium);
    text-decoration: none;
    color: inherit;
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
    flex-shrink: 0;
}

.action-icon.add {
    background: linear-gradient(135deg, var(--accent-green) 0%, #2ecc71 100%);
}

.action-icon.move {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
}

.action-icon.category {
    background: linear-gradient(135deg, var(--info-cyan) 0%, #3498db 100%);
}

.action-icon.warning {
    background: linear-gradient(135deg, var(--warning-orange) 0%, #e67e22 100%);
}

.action-content h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.action-content p {
    margin: 0;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .panel-content {
        padding: 1rem;
        max-height: 300px;
    }
}

@media (max-width: 576px) {
    .stock-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .stock-indicator {
        align-items: flex-start;
        min-width: auto;
    }
    
    .movement-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

/* Scrollbar personalizado para paneles */
.panel-content::-webkit-scrollbar {
    width: 6px;
}

.panel-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.panel-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.panel-content::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endpush
@endsection