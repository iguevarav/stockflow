@extends('layouts.app')

@section('title', 'Nuevo Producto - Sistema de Inventario')
@section('page-title', 'Nuevo Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">Nuevo</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="product-form-container">
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Información Básica -->
                <div class="product-card">
                    <div class="info-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i>
                            Información Básica
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-form-group">
                                    <label for="codigo">Código del Producto <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control product-input @error('codigo') is-invalid @enderror" 
                                           id="codigo" 
                                           name="codigo" 
                                           value="{{ old('codigo') }}" 
                                           placeholder="Ej: PROD001"
                                           required>
                                    @error('codigo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Código único del producto</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-form-group">
                                    <label for="categoria_id">Categoría <span class="text-danger">*</span></label>
                                    <select class="p-2 form-control product-select @error('categoria_id') is-invalid @enderror" 
                                            id="categoria_id" 
                                            name="categoria_id" 
                                            required>
                                        <option value="">Seleccione una categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" 
                                                    {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
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
                        
                        <div class="product-form-group">
                            <label for="nombre">Nombre del Producto <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control product-input @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}" 
                                   placeholder="Nombre descriptivo del producto"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="product-form-group">
                            <label for="ubicacion">Ubicación en Almacén</label>
                            <input type="text" 
                                   class="form-control product-input @error('ubicacion') is-invalid @enderror" 
                                   id="ubicacion" 
                                   name="ubicacion" 
                                   value="{{ old('ubicacion') }}" 
                                   placeholder="Ej: Estante A-5, Pasillo 2-B, Sección C">
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Indica dónde se encuentra físicamente el producto</small>
                        </div>
                        
                        <div class="product-form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control product-input @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      placeholder="Descripción detallada del producto (opcional)">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Precios -->
                <div class="product-card">
                    <div class="price-header">
                        <h3 class="card-title">
                            <i class="fas fa-dollar-sign"></i>
                            Información de Precios
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-form-group">
                                    <label for="precio_compra">Precio de Compra <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" 
                                               class="form-control product-input @error('precio_compra') is-invalid @enderror" 
                                               id="precio_compra" 
                                               name="precio_compra" 
                                               value="{{ old('precio_compra', '0.00') }}" 
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
                                <div class="product-form-group">
                                    <label for="precio_venta">Precio de Venta <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" 
                                               class="form-control product-input @error('precio_venta') is-invalid @enderror" 
                                               id="precio_venta" 
                                               name="precio_venta" 
                                               value="{{ old('precio_venta', '0.00') }}" 
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
                        
                        <div class="margin-alert">
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
                <div class="product-card">
                    <div class="stock-header">
                        <h3 class="card-title">
                            <i class="fas fa-cubes"></i>
                            Control de Stock
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="product-form-group">
                            <label for="stock_actual">Stock Inicial <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control product-input @error('stock_actual') is-invalid @enderror" 
                                   id="stock_actual" 
                                   name="stock_actual" 
                                   value="{{ old('stock_actual', '0') }}" 
                                   min="0"
                                   required>
                            @error('stock_actual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Cantidad inicial en inventario</small>
                        </div>
                        
                        <div class="product-form-group">
                            <label for="stock_minimo">Stock Mínimo <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control product-input @error('stock_minimo') is-invalid @enderror" 
                                   id="stock_minimo" 
                                   name="stock_minimo" 
                                   value="{{ old('stock_minimo', '5') }}" 
                                   min="0"
                                   required>
                            @error('stock_minimo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Alerta cuando llegue a esta cantidad</small>
                        </div>
                        
                        <div class="product-form-group">
                            <label for="unidad_medida">Unidad de Medida <span class="text-danger">*</span></label>
                            <select class="p-2 form-control product-select @error('unidad_medida') is-invalid @enderror" 
                                    id="unidad_medida" 
                                    name="unidad_medida" 
                                    required>
                                <option value="unidad" {{ old('unidad_medida', 'unidad') == 'unidad' ? 'selected' : '' }}>Unidad</option>
                                <option value="kg" {{ old('unidad_medida') == 'kg' ? 'selected' : '' }}>Kilogramo</option>
                                <option value="g" {{ old('unidad_medida') == 'g' ? 'selected' : '' }}>Gramo</option>
                                <option value="l" {{ old('unidad_medida') == 'l' ? 'selected' : '' }}>Litro</option>
                                <option value="ml" {{ old('unidad_medida') == 'ml' ? 'selected' : '' }}>Mililitro</option>
                                <option value="m" {{ old('unidad_medida') == 'm' ? 'selected' : '' }}>Metro</option>
                                <option value="cm" {{ old('unidad_medida') == 'cm' ? 'selected' : '' }}>Centímetro</option>
                                <option value="caja" {{ old('unidad_medida') == 'caja' ? 'selected' : '' }}>Caja</option>
                                <option value="paquete" {{ old('unidad_medida') == 'paquete' ? 'selected' : '' }}>Paquete</option>
                            </select>
                            @error('unidad_medida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Estado y Acciones -->
                <div class="product-card">
                    <div class="actions-header">
                        <h3 class="card-title">
                            <i class="fas fa-cogs"></i>
                            Estado y Acciones
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="custom-checkbox pl-3">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="activo" 
                                   name="activo" 
                                   value="1"
                                   {{ old('activo', true) ? 'checked' : '' }}>
                            <label class="form-check-label pl-3" for="activo">
                                Producto Activo
                            </label>
                        </div>
                        <small class="form-text">Los productos inactivos no aparecen en ventas</small>
                        
                        <hr class="section-divider">
                        
                        <button type="submit" class="btn btn-primary product-btn">
                            <i class="fas fa-save"></i> Crear Producto
                        </button>
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary product-btn">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </div>
                
                <!-- Consejos -->
                <div class="product-card">
                    <div class="tips-header">
                        <h3 class="card-title">
                            <i class="fas fa-lightbulb"></i>
                            Consejos
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul class="tips-list">
                            <li><i class="fas fa-check text-success"></i> Usa códigos únicos y descriptivos</li>
                            <li><i class="fas fa-check text-success"></i> Define un stock mínimo realista</li>
                            <li><i class="fas fa-check text-success"></i> Establece precios competitivos</li>
                            <li><i class="fas fa-check text-success"></i> Describe bien el producto</li>
                            <li><i class="fas fa-check text-success"></i> Especifica la ubicación para facilitar la búsqueda</li>
                        </ul>
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
                (Ganancia: $${ganancia.toFixed(2)})
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