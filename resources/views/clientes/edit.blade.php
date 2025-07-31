@extends('layouts.app')

@section('title', 'Editar Cliente - Sistema de Inventario')
@section('page-title', 'Editar Cliente')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Clientes</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection


@section('content')
<style>
    /* === NUEVO CLIENTE - ESTILO PREMIUM === */

/* Contenedor principal */
.container-custom {
    padding: 24px;
    background: #f8fafc;
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

/* Tarjeta de botones */
.table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

/* Header de acciones */
.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    border-radius: 16px 16px 0 0;
    color: white;
}

/* Mensaje de advertencia */
.table-header span.text-warning {
    font-weight: 600;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Botones de acción */
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
    color: #4338ca;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

/* Responsive para móviles */
@media (max-width: 768px) {
    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        text-align: left;
    }

    .btn-new-record,
    .btn-delete {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="container-custom">
    <!-- Formulario de edición -->
    @include('clientes.forms.form_edit_cliente')

    <!-- Contenedor de acciones -->
    <div class="table-container mt-4">
        <div class="table-header d-flex justify-content-between align-items-center flex-wrap">
            <span class="text-warning" style="font-weight:600; font-size:14px;">
                <i class="fas fa-exclamation-circle me-1"></i> Los campos con * son obligatorios
            </span>

            <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                <button class="btn btn-delete btnVolver" type="button">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </button>
                <button class="btn btn-new-record" type="submit" form="formActualizarCliente">
                    <i class="fa-solid fa-floppy-disk"></i> Actualizar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.btnVolver').addEventListener('click', function () {
            window.location.href = "{{ route('clientes.index') }}";
        });
    });
</script>
@endpush
