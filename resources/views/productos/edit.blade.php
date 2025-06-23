@extends('layouts.app')

@section('title', 'Editar Producto - Sistema de Inventario')
@section('page-title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="product-edit-container">
    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <!-- Información Básica -->
                <div class="product-edit-card">
                    <div class="edit-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Editar: {{ $producto->nombre }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-edit-form-group">
                                    <label for="codigo">Código del Producto <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control product-edit-input @error('codigo') is-invalid @enderror" 
                                           id="codigo" 
                                           name="codigo" 
                                           value="{{ old('codigo', $producto->codigo) }}" 
                                           placeholder="Ej: PROD001"
                                           required>
                                    @error('codigo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Código único del producto</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-edit-form-group">
                                    <label for="categoria_id">Categoría <span class="text-danger">*</span></label>
                                    <select class=" p-2 form-control product-edit-select @error('categoria_id') is-invalid @enderror" 
                                            id="categoria_id" 
                                            name="categoria_id" 
                                            required>
                                        <option value="">Seleccione una categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" 
                                                    {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-edit-form-group">
                            <label for="nombre">Nombre del Producto <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control product-edit-input @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $producto->nombre) }}" 
                                   placeholder="Nombre descriptivo del producto"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="product-edit-form-group">
                            <label for="ubicacion">Ubicación en Almacén</label>
                            <input type="text" 
                                   class="form-control product-edit-input @error('ubicacion') is-invalid @enderror" 
                                   id="ubicacion" 
                                   name="ubicacion" 
                                   value="{{ old('ubicacion', $producto->ubicacion) }}" 
                                   placeholder="Ej: Estante A-5, Pasillo 2-B, Sección C">
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Indica dónde se encuentra físicamente el producto</small>
                        </div>
                        
                        <div class="product-edit-form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control product-edit-input @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      placeholder="Descripción detallada del producto (opcional)">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Precios -->
                <div class="product-edit-card">
                    <div class="price-edit-header">
                        <h3 class="card-title">
                            <i class="fas fa-dollar-sign"></i>
                            Información de Precios
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-edit-form-group">
                                    <label for="precio_compra">Precio de Compra <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" 
                                               class="form-control product-edit-input @error('precio_compra') is-invalid @enderror" 
                                               id="precio_compra" 
                                               name="precio_compra" 
                                               value="{{ old('precio_compra', $producto->precio_compra) }}" 
                                               step="0.01" 
                                               min="0"
                                               required>
                                        @error('precio_compra')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text">Precio al que compras el producto</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-edit-form-group">
                                    <label for="precio_venta">Precio de Venta <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" 
                                               class="form-control product-edit-input @error('precio_venta') is-invalid @enderror" 
                                               id="precio_venta" 
                                               name="precio_venta" 
                                               value="{{ old('precio_venta', $producto->precio_venta) }}" 
                                               step="0.01" 
                                               min="0"
                                               required>
                                        @error('precio_venta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text">Precio al que vendes el producto</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="margin-edit-alert">
                            <i class="fas fa-calculator"></i>
                            <div>
                                <strong>Margen de ganancia:</strong> <span id="margen-ganancia">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Stock -->
                <div class="product-edit-card">
                    <div class="stock-edit-header">
                        <h3 class="card-title">
                            <i class="fas fa-cubes"></i>
                            Control de Stock
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="stock-current-alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Stock Actual:</strong> {{ $producto->stock_actual }} {{ $producto->unidad_medida }}
                                <br><small>Para modificar el stock, use el sistema de movimientos</small>
                            </div>
                        </div>
                        
                        <div class="product-edit-form-group">
                            <label for="stock_minimo">Stock Mínimo <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control product-edit-input @error('stock_minimo') is-invalid @enderror" 
                                   id="stock_minimo" 
                                   name="stock_minimo" 
                                   value="{{ old('stock_minimo', $producto->stock_minimo) }}" 
                                   min="0"
                                   required>
                            @error('stock_minimo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Alerta cuando llegue a esta cantidad</small>
                        </div>
                        
                        <div class="product-edit-form-group">
                            <label for="unidad_medida">Unidad de Medida <span class="text-danger">*</span></label>
                            <select class=" p-2 form-control product-edit-select @error('unidad_medida') is-invalid @enderror" 
                                    id="unidad_medida" 
                                    name="unidad_medida" 
                                    required>
                                <option value="unidad" {{ old('unidad_medida', $producto->unidad_medida) == 'unidad' ? 'selected' : '' }}>Unidad</option>
                                <option value="kg" {{ old('unidad_medida', $producto->unidad_medida) == 'kg' ? 'selected' : '' }}>Kilogramo</option>
                                <option value="g" {{ old('unidad_medida', $producto->unidad_medida) == 'g' ? 'selected' : '' }}>Gramo</option>
                                <option value="l" {{ old('unidad_medida', $producto->unidad_medida) == 'l' ? 'selected' : '' }}>Litro</option>
                                <option value="ml" {{ old('unidad_medida', $producto->unidad_medida) == 'ml' ? 'selected' : '' }}>Mililitro</option>
                                <option value="m" {{ old('unidad_medida', $producto->unidad_medida) == 'm' ? 'selected' : '' }}>Metro</option>
                                <option value="cm" {{ old('unidad_medida', $producto->unidad_medida) == 'cm' ? 'selected' : '' }}>Centímetro</option>
                                <option value="caja" {{ old('unidad_medida', $producto->unidad_medida) == 'caja' ? 'selected' : '' }}>Caja</option>
                                <option value="paquete" {{ old('unidad_medida', $producto->unidad_medida) == 'paquete' ? 'selected' : '' }}>Paquete</option>
                            </select>
                            @error('unidad_medida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Campo oculto para mantener el stock actual -->
                        <input type="hidden" name="stock_actual" value="{{ $producto->stock_actual }}">
                    </div>
                </div>
                
                <!-- Estado y Acciones -->
                <div class="product-edit-card">
                    <div class="actions-edit-header">
                        <h3 class="card-title">
                            <i class="fas fa-cogs"></i>
                            Estado y Acciones
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="custom-edit-checkbox">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="activo" 
                                   name="activo" 
                                   value="1"
                                   {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">
                                Producto Activo
                            </label>
                        </div>
                        <small class="form-text">Los productos inactivos no aparecen en ventas</small>
                        
                        <hr class="section-edit-divider">
                        
                        <button type="submit" class="btn btn-primary product-edit-btn">
                            <i class="fas fa-save"></i> Actualizar Producto
                        </button>
                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-info product-edit-btn">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </a>
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary product-edit-btn">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </div>
                
                <!-- Información del Producto -->
                <div class="product-edit-card">
                    <div class="info-edit-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i>
                            Información
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table info-edit-table">
                            <tr>
                                <th>ID:</th>
                                <td>{{ $producto->id }}</td>
                            </tr>
                            <tr>
                                <th>Creado:</th>
                                <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Actualizado:</th>
                                <td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Movimientos:</th>
                                <td>
                                    <span class="badge edit-badge">
                                        {{ $producto->movimientos()->count() }} registros
                                    </span>
                                </td>
                            </tr>
                        </table>
                        
                        <hr class="section-edit-divider">
                        
                        <div class="btn-group-edit">
                            <a href="{{ route('movimientos.create', ['producto_id' => $producto->id]) }}" 
                               class="btn btn-success product-edit-btn" style="margin: 0 0.25rem 0 0;">
                                <i class="fas fa-exchange-alt"></i> Nuevo Movimiento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const precioCompra = document.getElementById('precio_compra');
    const precioVenta = document.getElementById('precio_venta');
    const margenElement = document.getElementById('margen-ganancia');
    
    function calcularMargen() {
        const compra = parseFloat(precioCompra.value) || 0;
        const venta = parseFloat(precioVenta.value) || 0;
        
        if (compra > 0 && venta > 0) {
            const margen = ((venta - compra) / venta) * 100;
            const ganancia = venta - compra;
            
            margenElement.innerHTML = `
                <strong>${margen.toFixed(1)}%</strong> 
                (Ganancia: ${ganancia.toFixed(2)})
            `;
            
            if (margen < 0) {
                margenElement.className = 'text-danger';
            } else if (margen < 20) {
                margenElement.className = 'text-warning';
            } else {
                margenElement.className = 'text-success';
            }
        } else {
            margenElement.innerHTML = '-';
            margenElement.className = '';
        }
    }
    
    precioCompra.addEventListener('input', calcularMargen);
    precioVenta.addEventListener('input', calcularMargen);
    
    // Calcular margen inicial
    calcularMargen();
});
</script>
@endsection