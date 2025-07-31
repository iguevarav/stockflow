@extends('layouts.app')

@section('title', 'Detalle Venta')
@section('page-title', 'Detalle de la Venta')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Ventas</a></li>
<li class="breadcrumb-item active">Detalle</li>
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
        margin-bottom: 24px;
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 24px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 16px 16px 0 0;
    }

    .table-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #tabla_detalle_venta th {
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e5e7eb;
    }

    #tabla_detalle_venta td {
        padding: 18px 20px;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }

    #tabla_detalle_venta tr:hover {
        background: #f9fafb;
        transition: background 0.2s ease;
    }

    .bg-light {
        background: #f3f4f6 !important;
        border: 1px solid #e5e7eb;
    }

    .btnVolver {
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .btnVolver:hover {
        transform: translateY(-2px);
        background-color: #dc2626 !important;
        color: white;
    }

    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }

        .btnVolver {
            width: 100%;
            justify-content: center;
        }

        .bg-light {
            flex-direction: column !important;
            text-align: center;
        }
    }
</style>

<div class="container-custom">

    {{-- Información de la venta --}}
    <div class="table-container mb-4">
        <div class="table-header">
            <h3><i class="fas fa-file-invoice"></i> Detalle Venta</h3>
            

        </div>
        <div class="p-4">
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    <strong class="text-muted">N° Documento:</strong>
                    <p class="fw-bold text-primary m-0">{{ $venta->numero_documento }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <strong class="text-muted">Cliente:</strong>
                    <p class="m-0 text-dark">{{ $venta->cliente->nombre }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <strong class="text-muted">Fecha:</strong>
                    <p class="m-0 text-dark">{{ $venta->fecha_venta->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="table-container mb-4">
        <div class="table-header">
            <h3><i class="fas fa-boxes"></i> Productos Vendidos</h3>
        </div>
        <div class="table-responsive">
            <table class="table" id="tabla_detalle_venta">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>S/. {{ number_format($detalle->precio_venta, 2) }}</td>
                        <td>S/. {{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Total y botón volver --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 bg-light p-4 rounded shadow-sm">
        <h5 class="m-0 fw-bold text-dark">
            Total: <span class="text-success" style="font-size:20px;">S/. {{ number_format($venta->subtotal, 2) }}</span>
        </h5>
        <button class="btn btn-danger btnVolver" type="button">
            <i class="fa-solid fa-door-open me-2"></i> VOLVER
        </button>
    </div>

</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.btnVolver').addEventListener('click', function() {
            window.location.href = "{{ route('ventas.index') }}";
        });
    });
</script>
@endsection