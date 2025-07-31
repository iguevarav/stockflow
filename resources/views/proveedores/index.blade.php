@extends('layouts.app')

@section('title', 'Proveedores - Sistema de Inventario')
@section('page-title', 'Gestión de Proveedores')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Proveedores</li>
@endsection


@section('content')
<style>
    /* === PROVEEDORES - ESTILO PREMIUM === */

/* Container principal */
.container-custom {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Header con gradiente y filtros */
.filters-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 24px;
    color: white;
}

.filters-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Controles de búsqueda dentro del header */
.search-controls {
    margin-top: 16px;
}

.search-form {
    display: flex;
    justify-content: center;
}

.form-inline {
    width: 100%;
    max-width: 600px;
}

.search-group {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.form-control {
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    padding: 12px 18px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    flex: 1;
    backdrop-filter: blur(10px);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.form-control:focus {
    border-color: rgba(255, 255, 255, 0.6);
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.2);
    outline: none;
}

.btn-search {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 14px;
    color: white;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-search:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-1px);
}

.btn-clear {
    background: rgba(239, 68, 68, 0.2);
    border: 2px solid rgba(239, 68, 68, 0.3);
    border-radius: 12px;
    padding: 12px;
    color: white;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
}

.btn-clear:hover {
    background: rgba(239, 68, 68, 0.3);
    transform: translateY(-1px);
}

/* Botón nuevo registro en header de tabla */
.btn-new-record {
    background: white;
    color: #4f46e5;
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.btn-new-record:hover {
    background: #f8fafc;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: #4338ca;
}

/* Alertas */
.alert {
    border: none;
    border-radius: 12px;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.alert-warning {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border-left: 4px solid #f59e0b;
}

.alert-dismissible .close {
    font-size: 20px;
    font-weight: 300;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.alert-dismissible .close:hover {
    opacity: 1;
}

/* Contenedor de tabla */
.table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    margin-bottom: 24px;
}

/* Contenedor de paginación */
.pagination-container {
    padding: 20px;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
}

/* Header de tabla */
.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-header h3 {
    color: white;
    margin: 0;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.table-count {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Tabla */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #f8fafc;
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #e5e7eb;
}

td {
    padding: 20px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 14px;
    color: #374151;
    vertical-align: middle;
}

tr:hover {
    background: #f9fafb;
    transition: background 0.2s ease;
}

/* Avatar circular */
.provider-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #4f46e5;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    margin-right: 16px;
    flex-shrink: 0;
}

.provider-info {
    display: flex;
    align-items: center;
}

.provider-details h6 {
    margin: 0;
    font-weight: 600;
    font-size: 15px;
    color: #111827;
}

.provider-details p {
    margin: 4px 0 0 0;
    font-size: 13px;
    color: #6b7280;
}

/* Badges */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.badge-danger {
    background: #fecaca;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #93c5fd;
}

/* Botones de acción */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-view {
    background: #e0f2fe;
    color: #0277bd;
}

.btn-view:hover {
    background: #b3e5fc;
    transform: scale(1.1);
}

.btn-edit {
    background: #f3e8ff;
    color: #7c3aed;
}

.btn-edit:hover {
    background: #e9d5ff;
    transform: scale(1.1);
}

.btn-delete {
    background: #fce4ec;
    color: #c2185b;
}

.btn-delete:hover {
    background: #f8bbd9;
    transform: scale(1.1);
}

/* Paginación */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 24px;
}

.page-link {
    padding: 10px 16px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #4f46e5;
    color: white;
    border-color: #4f46e5;
}

.page-item.active .page-link {
    background: #4f46e5;
    border-color: #4f46e5;
    color: white;
}

/* Responsivo */
@media (max-width: 768px) {
    .container-custom {
        padding: 16px;
    }
    
    .search-group {
        flex-direction: column;
        gap: 12px;
    }
    
    .form-control {
        width: 100%;
    }
    
    .btn-search, .btn-clear {
        width: 100%;
    }
    
    .btn-clear {
        width: 48px;
        height: 48px;
    }
    
    .table-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .btn-new-record {
        width: 100%;
        justify-content: center;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .provider-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
}

/* === CSS ADICIONAL PARA TABLA DE PROVEEDORES === */

/* Tabla principal */
#table_proveedores {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

#table_proveedores thead {
    background: #f8fafc;
}

#table_proveedores th {
    background: #f8fafc;
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 12px;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 10;
}

#table_proveedores td {
    padding: 20px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 14px;
    color: #374151;
    vertical-align: middle;
}

#table_proveedores tbody tr {
    transition: all 0.2s ease;
}

#table_proveedores tbody tr:hover {
    background: #f9fafb;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Primera columna (ID) con avatar estilo */
#table_proveedores td:first-child {
    font-weight: 600;
    color: #4f46e5;
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    border-radius: 8px;
    text-align: center;
    margin: 8px;
    width: 60px;
    position: relative;
}

/* Razón social destacada */
#table_proveedores td:nth-child(2) {
    font-weight: 600;
    color: #111827;
    font-size: 15px;
}

/* RUC con estilo código */
#table_proveedores td:nth-child(3) {
    font-family: 'Courier New', monospace;
    background: #f3f4f6;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    color: #374151;
}

/* Tipo proveedor con badge */
#table_proveedores td:nth-child(4) {
    position: relative;
}

#table_proveedores td:nth-child(4)::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    margin-right: 8px;
}

/* Email con icono */
#table_proveedores td:nth-child(6) {
    color: #4f46e5;
    font-size: 13px;
}

/* Teléfono con formato */
#table_proveedores td:nth-child(5) {
    font-family: 'Courier New', monospace;
    font-size: 13px;
    color: #059669;
    font-weight: 500;
}

/* Dirección truncada */
#table_proveedores td:nth-child(7) {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #6b7280;
    font-size: 13px;
}

/* Columna de acciones */
#table_proveedores td:last-child {
    width: 160px;
    text-align: center;
}

/* Botones de acción rediseñados */
.btn-sm {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin: 2px;
    text-decoration: none;
}

.btn-info {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.btn-info:hover {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    color: white;
}

/* Formulario inline para delete */
form[style*="display:inline"] {
    display: inline-flex !important;
    margin: 0;
}

/* Responsivo para tabla */
@media (max-width: 1200px) {
    #table_proveedores td:nth-child(7) {
        max-width: 150px;
    }
}

@media (max-width: 768px) {
    #table_proveedores {
        font-size: 12px;
    }
    
    #table_proveedores th,
    #table_proveedores td {
        padding: 12px 8px;
    }
    
    #table_proveedores td:nth-child(7) {
        display: none;
    }
    
    #table_proveedores th:nth-child(7) {
        display: none;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 11px;
    }
    
    .btn-sm i {
        display: none;
    }
}
</style>

<div class="container-custom">
    
    <!-- Header con filtros -->
    <div class="filters-header">
        <h3><i class="fas fa-filter"></i> Filtros de Búsqueda</h3>
        
        <div class="search-controls mt-3">
            <div class="search-form">
                <form class="form-inline" method="GET" action="{{ route('proveedores.buscar')}}">
                    <div class="search-group">
                        <input name="buscarpor" class="form-control" type="search" 
                               placeholder="Nombre, RUC, teléfono o ubicación..." 
                               aria-label="Search" id="searchInput"
                               value="{{ request('buscarpor') }}">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        @if(request('buscarpor'))
                            <a href="{{ route('proveedores.index') }}" class="btn btn-clear">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('datos'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ session('datos') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Contenedor de tabla -->
    <div class="table-container">
        <!-- Header de tabla -->
        <div class="table-header">
            <h3>
                <i class="fas fa-truck"></i> Lista de Proveedores
                <span class="table-count">{{ $proveedor->total() }} totales</span>
            </h3>
            <a href="{{route('proveedores.create')}}" class="btn btn-new-record">
                <i class="fas fa-plus"></i> Nuevo Proveedor
            </a>
        </div>

        <!-- Tabla responsive -->
        <div class="table-responsive">
            @include('proveedores.tables.table_list_proveedores')
        </div>

        <!-- Paginación -->
        @if($proveedor->hasPages())
        <div class="pagination-container">
            {{ $proveedor->links() }}
        </div>
        @endif
    </div>

</div>
@endsection