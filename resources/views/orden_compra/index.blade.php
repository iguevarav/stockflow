@extends('layouts.app')

@section('title', 'Compras - Sistema de Inventario')
@section('page-title', 'Gestión de Compras')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Compras</li>
@endsection

@section('content')
<style>
    .container-custom {
        padding: 24px;
        background: #f8fafc;
        min-height: 100vh;
    }

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

    .table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 24px;
    }

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

    .btn-new-record {
        background: white;
        color: #4338ca;
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
        color: #0284c7;
    }

    /* === TABLA DE ÓRDENES DE COMPRA - ESTILO PREMIUM === */

    /* Tabla principal */
    #table_orden_compra {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    #table_orden_compra thead {
        background: #f8fafc;
    }

    #table_orden_compra th {
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

    #table_orden_compra td {
        padding: 20px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }

    #table_orden_compra tbody tr {
        transition: all 0.2s ease;
    }

    #table_orden_compra tbody tr:hover {
        background: #f9fafb;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Primera columna (ID) destacada */
    #table_orden_compra td:first-child {
        font-weight: 600;
        color: #4f46e5;
        background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
        border-radius: 8px;
        text-align: center;
        width: 60px;
    }

    /* Estado con badge */
    #table_orden_compra td:nth-child(6) {
        font-weight: 600;
        text-transform: capitalize;
    }

    #table_orden_compra td:nth-child(6):before {
        content: "● ";
        color: #10b981;
        font-size: 16px;
        vertical-align: middle;
    }

    /* Columna de acciones */
    #table_orden_compra td:last-child {
        text-align: center;
    }

    /* Botones de acción */
    .btn-sm {
        padding: 8px 12px;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    /* Formulario inline para acciones */
    form[style*="display:inline"] {
        display: inline-flex !important;
        margin: 0;
    }

    /* Responsivo */
    @media (max-width: 768px) {

        #table_orden_compra th,
        #table_orden_compra td {
            padding: 12px 8px;
            font-size: 12px;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 11px;
        }

        .btn-sm i {
            display: none;
        }
    }
</style>

<div class="container-custom">
    <!-- Filtros de búsqueda -->
    <div class="filters-header">
        <h3><i class="fas fa-filter"></i> Buscar Orden de Compra</h3>
        <div class="search-controls mt-3">
            <div class="search-form">
                <form class="form-inline" method="GET" action="{{ route('orden_compra.buscar')}}">
                    <div class="search-group">
                        <input name="buscarpor" class="form-control" type="search" placeholder="Buscar por nombre o razón social..." value="{{ request('buscarpor') }}">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        @if(request('buscarpor'))
                        <a href="{{ route('orden_compra.index') }}" class="btn btn-search" title="Limpiar">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla con datos -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-file-invoice-dollar"></i> Lista de Ordenes de Compra <span class="table-count">{{ $ordenes->total() }} totales</span></h3>
            <a href="{{route('orden_compra.create')}}" class="btn btn-new-record">
                <i class="fas fa-plus"></i> Nueva Orden
            </a>
        </div>

        <div class="table-responsive">
            @include('orden_compra.tables.table_list_orden_compra')
        </div>

        @if($ordenes->hasPages())
        <div class="pagination-container p-4">
            {{ $ordenes->links() }}
        </div>
        @endif
    </div>
</div>
@endsection