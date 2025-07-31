@extends('layouts.app')

@section('title', 'Registrar Orden de Compra - Sistema de Inventario')
@section('page-title', 'Registrar Orden de Compra')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('orden_compra.index') }}">Órdenes de Compra</a></li>
<li class="breadcrumb-item active">Registrar</li>
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
</style>
<div class="container-custom">

    <!-- Encabezado superior -->
    <div class="filters-header">
        <h3><i class="fas fa-file-invoice"></i> Formulario de Registro</h3>
        <p style="margin-top: 10px;">Completa los campos para registrar una nueva orden de compra.</p>
    </div>

    <!-- Formulario -->
    <div class="card-style settings-card-1 mb-30 p-4" style="background: white; border-radius: 16px;">
        @include('orden_compra.forms.form_create_orden_compra')
    </div>

    <!-- Footer con acciones -->
    <div class="card-style settings-card-1 mb-30 p-3 d-flex justify-content-between align-items-center" style="background: #f9fafb; border-radius: 16px;">
        <span style="color:#b45309; font-size:14px; font-weight:bold;">
            <i class="fas fa-asterisk"></i> Los campos con * son obligatorios
        </span>

        <div class="d-flex gap-2">
            <button class="btn btn-danger btnVolver" type="button">
                <i class="fa-solid fa-door-open"></i> VOLVER
            </button>
            <button class="btn btn-primary" type="submit" form="formRegistrarOrdenCompra">
                <i class="fa-solid fa-floppy-disk"></i> REGISTRAR
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