@extends('layouts.app')

@section('title', 'Ventas - Sistema')
@section('page-title', 'Gestión de Ventas')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Ventas</li>
@endsection

@section('content')
<style>
    .container-custom {
        padding: 24px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        border-radius: 16px 16px 0 0;
    }

    .table-header h3 {
        font-weight: 600;
        font-size: 18px;
    }

    .table-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table thead th {
        background: #f3f4f6;
        color: #374151;
        text-transform: uppercase;
        font-weight: 600;
        padding: 16px;
        font-size: 13px;
        border: none;
    }

    .table tbody tr {
        background: #f9fafb;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        transition: 0.2s ease;
    }

    .table tbody tr td {
        padding: 16px;
        vertical-align: middle;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #fff;
        font-size: 14px;
        color: #374151;
    }

    .table tbody tr td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        text-align: center;
        color: #6366f1;
        font-weight: bold;
        background: linear-gradient(120deg, #dbeafe, #e0e7ff);
    }

    .table tbody tr td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .estado-pendiente {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #059669;
        font-weight: 600;
    }

    .estado-pendiente::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        display: inline-block;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 10px;
        font-size: 14px;
        border-radius: 8px;
        color: white;
        margin-right: 6px;
        border: none;
        transition: 0.2s ease;
    }

    .btn-edit {
        background: #2563eb;
    }

    .btn-view {
        background: #3b82f6;
    }

    .btn-delete {
        background: #ef4444;
    }

    .btn-approve {
        background: #059669;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .btn-new-record {
        background: white;
        color: #4338ca;
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s ease;
        border: none;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .btn-new-record:hover {
        background: #f0fdf4;
        transform: translateY(-2px);
    }
</style>

<div class="container-custom">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-shopping-cart"></i> Lista de Ventas <span class="table-count">{{ $ventas->total() }} totales</span></h3>
            <a href="{{ route('ventas.create') }}" class="btn btn-new-record">
                <i class="fas fa-plus"></i> Nueva Venta
            </a>
        </div>

        <div class="table-responsive p-3">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total (S/.)</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $index => $venta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $venta->numero_documento }}</td>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->fecha_venta->format('d/m/Y') }}</td>
                        <td>{{ number_format($venta->subtotal, 2) }}</td>
                        <td><span class="estado-pendiente">Pendiente</span></td>
                        <td>
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Eliminar" onclick="return confirm('¿Deseas eliminar esta venta?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($ventas->hasPages())
        <div class="pagination-container p-4">
            {{ $ventas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
