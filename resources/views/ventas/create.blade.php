@extends('layouts.app')

@section('title', 'Registrar Venta')
@section('page-title', 'Nueva Venta')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Ventas</a></li>
<li class="breadcrumb-item active">Registrar</li>
@endsection

@section('content')

<style>
.form-section {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}

.form-section h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #10b981;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #374151;
}

.form-control {
    border-radius: 12px;
    border: 1px solid #d1d5db;
    padding: 12px;
    width: 100%;
    font-size: 14px;
}

.form-control:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    outline: none;
}

.product-table th,
.product-table td {
    padding: 12px 16px;
    font-size: 14px;
    text-align: left;
}

.product-table th {
    background: #f0fdf4;
    color: #065f46;
    font-weight: 600;
}

.product-table td input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 8px;
    font-size: 14px;
}

.btn-agregar,
.btn-quitar {
    background: #10b981;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-quitar {
    background: #ef4444;
}

.btn-agregar:hover {
    background: #059669;
}

.btn-quitar:hover {
    background: #dc2626;
}

.total-section {
    text-align: right;
    font-size: 16px;
    font-weight: 600;
    margin-top: 24px;
    color: #065f46;
}

/* Estilo general de la tarjeta */
.card {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Cabecera */
.card-header {
    font-weight: 600;
    background-color: #f8f9fa;
    color: #343a40;
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid #dee2e6;
}

/* Botón agregar producto */
.card-header .btn-success {
    font-size: 0.875rem;
    padding: 0.3rem 0.75rem;
}

/* Tabla */
#tabla-productos {
    width: 100%;
    border-collapse: collapse;
}

#tabla-productos thead th {
    background-color: #f1f3f5;
    color: #212529;
    text-align: left;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
}

#tabla-productos tbody td {
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
    padding: 0.5rem;
}

#tabla-productos .form-control {
    font-size: 0.9rem;
    height: 2rem;
    padding: 0.25rem 0.5rem;
}

/* Botón eliminar fila */
#tabla-productos .btn-danger {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
}

/* Subtotales */
.subtotal {
    font-weight: bold;
    font-size: 0.95rem;
    color: #198754;
}

/* Footer del carrito */
.card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 0.75rem 1.25rem;
}

#total-general {
    color: #0d6efd;
    font-weight: 700;
}

</style>


<div class="container-custom p-4 bg-white rounded shadow-sm">
    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Fecha de Venta</label>
            <input type="date" name="fecha_venta" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div id="carrito-productos">
            @include('ventas.partials.carrito')
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Guardar Venta</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
