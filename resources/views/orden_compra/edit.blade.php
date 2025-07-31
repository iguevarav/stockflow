@extends('layouts.app')

@section('title', 'Editar Compra - Sistema de Inventario')
@section('page-title', 'Editar Orden de Compra')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('orden_compra.index') }}">Órdenes de Compra</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection


@section('content')
<style>
    /* === FORMULARIO ORDEN DE COMPRA === */

    .container-custom {
        padding: 24px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .filters-header {
        background: linear-gradient(135deg, #4f46e5 0%, #6d28d9 100%);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .filters-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-style {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb, #1e3a8a);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626, #991b1b);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    /* Responsive ajustes */
    @media (max-width: 768px) {
        .btn {
            width: 100%;
            justify-content: center;
        }

        .d-flex {
            flex-direction: column;
            gap: 12px;
        }

        .filters-header h3 {
            font-size: 16px;
        }
    }

    /* ===== TABLA DE PRODUCTOS EN EDICIÓN ===== */

    #tablaProductos {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        font-size: 14px;
    }

    /* Encabezado */
    #tablaProductos thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    #tablaProductos th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #ddd;
    }

    /* Celdas del cuerpo */
    #tablaProductos td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
    }

    /* Filas al pasar el cursor */
    #tablaProductos tbody tr:hover {
        background: #f9fafb;
        transition: all 0.2s ease;
    }

    /* Inputs dentro de las celdas */
    #tablaProductos input[type="number"],
    #tablaProductos input[type="text"] {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #f9fafb;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    #tablaProductos input[type="number"]:focus,
    #tablaProductos input[type="text"]:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Botón eliminar */
    .btnEliminarFila {
        background: #f87171;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: background 0.3s ease;
        cursor: pointer;
    }

    .btnEliminarFila:hover {
        background: #ef4444;
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {

        #tablaProductos th,
        #tablaProductos td {
            padding: 12px;
            font-size: 13px;
        }

        #tablaProductos input[type="number"],
        #tablaProductos input[type="text"] {
            font-size: 13px;
            padding: 6px 10px;
        }

        .btnEliminarFila {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
</style>
<div class="container-custom">

    <!-- Header superior -->
    <div class="filters-header">
        <h3><i class="fas fa-pen-alt"></i> Editar Orden de Compra</h3>
        <p style="margin-top: 10px;">Modifica los datos necesarios para actualizar esta orden.</p>
    </div>

    <!-- Formulario -->
    <div class="card-style settings-card-1 mb-30 p-4" style="background: white; border-radius: 16px;">
        @include('orden_compra.forms.form_edit_orden_compra')
    </div>

    <!-- Footer de acciones -->
    <div class="card-style settings-card-1 mb-30 p-3 d-flex justify-content-between align-items-center" style="background: #f9fafb; border-radius: 16px;">
        <span style="color:#b45309; font-size:14px; font-weight:bold;">
            <i class="fas fa-asterisk"></i> Los campos con * son obligatorios
        </span>

        <div class="d-flex gap-2">
            <button class="btn btn-danger btnVolver" type="button">
                <i class="fa-solid fa-door-open"></i> VOLVER
            </button>
            <button class="btn btn-primary" type="submit" form="formActualizarOrdenCompra">
                <i class="fa-solid fa-floppy-disk"></i> ACTUALIZAR
            </button>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.btnVolver').addEventListener('click', function() {
            window.location.href = "{{ route('orden_compra.index') }}";
        });
    });
</script>
@endsection