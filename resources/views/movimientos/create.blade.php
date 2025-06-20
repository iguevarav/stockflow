@extends('layouts.app')

@section('title', 'Nuevo Movimiento - Sistema de Inventario')
@section('page-title', 'Nuevo Movimiento de Inventario')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('movimientos.index') }}">Movimientos</a></li>
<li class="breadcrumb-item active">Nuevo</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="movement-form-container">
    <form action="{{ route('movimientos.store') }}" method="POST" id="movimiento-form">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Información del Movimiento -->
                <div class="movement-card">
                    <div class="movement-main-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus"></i>
                            Registrar Nuevo Movimiento
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="movement-form-group">
                                    <label for="producto_id">Producto <span class="text-danger">*</span></label>
                                    <select class=" p-2 form-control movement-select @error('producto_id') is-invalid @enderror" 
                                            id="producto_id" 
                                            name="producto_id" 
                                            required>
                                        <option value="">Seleccione un producto</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}" 
                                                    data-stock="{{ $producto->stock_actual }}"
                                                    data-unidad="{{ $producto->unidad_medida }}"
                                                    data-precio-compra="{{ $producto->precio_compra }}"
                                                    data-precio-venta="{{ $producto->precio_venta }}"
                                                    {{ old('producto_id', $producto_seleccionado?->id) == $producto->id ? 'selected' : '' }}>
                                                [{{ $producto->codigo }}] {{ $producto->nombre }} (Stock: {{ $producto->stock_actual }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('producto_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="movement-form-group">
                                    <label for="tipo_movimiento">Tipo de Movimiento <span class="text-danger">*</span></label>
                                    <select class="p-2 form-control movement-select @error('tipo_movimiento') is-invalid @enderror" 
                                            id="tipo_movimiento" 
                                            name="tipo_movimiento" 
                                            required>
                                        <option value="">Seleccione el tipo</option>
                                        <option value="entrada" {{ old('tipo_movimiento') == 'entrada' ? 'selected' : '' }}>
                                            Entrada (Agregar stock)
                                        </option>
                                        <option value="salida" {{ old('tipo_movimiento') == 'salida' ? 'selected' : '' }}>
                                            Salida (Reducir stock)
                                        </option>
                                        <option value="ajuste" {{ old('tipo_movimiento') == 'ajuste' ? 'selected' : '' }}>
                                            Ajuste (Corrección de inventario)
                                        </option>
                                    </select>
                                    @error('tipo_movimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="movement-form-group">
                                    <label for="cantidad">Cantidad <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control movement-input @error('cantidad') is-invalid @enderror" 
                                           id="cantidad" 
                                           name="cantidad" 
                                           value="{{ old('cantidad') }}" 
                                           min="1"
                                           required>
                                    @error('cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text" id="cantidad-help">
                                        <span id="unidad-medida"></span>
                                        <span id="stock-disponible"></span>
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="movement-form-group">
                                    <label for="precio_unitario">Precio Unitario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" 
                                               class="form-control movement-input @error('precio_unitario') is-invalid @enderror" 
                                               id="precio_unitario" 
                                               name="precio_unitario" 
                                               value="{{ old('precio_unitario') }}" 
                                               step="0.01" 
                                               min="0">
                                        @error('precio_unitario')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text">Opcional. Útil para calcular el valor del movimiento</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="movement-form-group">
                            <label for="motivo">Motivo del Movimiento</label>
                            <input type="text" 
                                   class="form-control movement-input @error('motivo') is-invalid @enderror" 
                                   id="motivo" 
                                   name="motivo" 
                                   value="{{ old('motivo') }}" 
                                   placeholder="Ej: Compra, Venta, Inventario inicial, Producto dañado, etc.">
                            @error('motivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="movement-form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control movement-input @error('observaciones') is-invalid @enderror" 
                                      id="observaciones" 
                                      name="observaciones" 
                                      rows="4" 
                                      placeholder="Información adicional sobre el movimiento (opcional)">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="movement-footer">
                        <button type="submit" class="btn btn-success movement-btn">
                            <i class="fas fa-save"></i> Registrar Movimiento
                        </button>
                        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary movement-btn">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Información del Producto Seleccionado -->
                <div class="movement-card" id="info-producto" style="display: none;">
                    <div class="product-info-header">
                        <h3 class="card-title">
                            <i class="fas fa-box"></i>
                            Información del Producto
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table product-table">
                            <tr>
                                <th>Código:</th>
                                <td id="producto-codigo">-</td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td id="producto-nombre">-</td>
                            </tr>
                            <tr>
                                <th>Stock Actual:</th>
                                <td>
                                    <span id="producto-stock" class="badge badge-info movement-badge">-</span>
                                    <span id="producto-unidad">-</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Precio Compra:</th>
                                <td>$<span id="producto-precio-compra">-</span></td>
                            </tr>
                            <tr>
                                <th>Precio Venta:</th>
                                <td>$<span id="producto-precio-venta">-</span></td>
                            </tr>
                        </table>
                        
                        <div id="stock-resultado" class="stock-alert" style="display: none;">
                            <strong>Stock después del movimiento:</strong>
                            <span id="nuevo-stock"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Resumen del Movimiento -->
                <div class="movement-card" id="resumen-movimiento" style="display: none;">
                    <div class="summary-header">
                        <h3 class="card-title">
                            <i class="fas fa-calculator"></i>
                            Resumen del Movimiento
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table product-table">
                            <tr>
                                <th>Tipo:</th>
                                <td id="resumen-tipo">-</td>
                            </tr>
                            <tr>
                                <th>Cantidad:</th>
                                <td id="resumen-cantidad">-</td>
                            </tr>
                            <tr>
                                <th>Precio Unitario:</th>
                                <td>$<span id="resumen-precio">-</span></td>
                            </tr>
                            <tr>
                                <th>Valor Total:</th>
                                <td><strong>$<span id="resumen-total">-</span></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Consejos según el tipo -->
                <div class="movement-card">
                    <div class="tips-header">
                        <h3 class="card-title">
                            <i class="fas fa-lightbulb"></i>
                            Tipos de Movimiento
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="movement-type-tip entrada">
                            <h6><span class="badge badge-success movement-badge">Entrada</span></h6>
                            <small>
                                Usa cuando recibas mercancía nueva, compras, devoluciones de clientes, etc.
                            </small>
                        </div>
                        
                        <div class="movement-type-tip salida">
                            <h6><span class="badge badge-danger movement-badge">Salida</span></h6>
                            <small>
                                Usa cuando vendas productos, se dañen, los devuelvas a proveedores, etc.
                            </small>
                        </div>
                        
                        <div class="movement-type-tip ajuste">
                            <h6><span class="badge badge-warning movement-badge">Ajuste</span></h6>
                            <small>
                                Usa para corregir diferencias en inventario físico vs. sistema.
                            </small>
                        </div>
                    </div>
                </div>
                
                <!-- Motivos sugeridos -->
                <div class="movement-card">
                    <div class="suggestions-header">
                        <h3 class="card-title">
                            <i class="fas fa-tags"></i>
                            Motivos Sugeridos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="motivos-sugeridos">
                            <!-- Se llenarán dinámicamente con JavaScript -->
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
    const productoSelect = document.getElementById('producto_id');
    const tipoSelect = document.getElementById('tipo_movimiento');
    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precio_unitario');
    const motivoInput = document.getElementById('motivo');
    const infoProducto = document.getElementById('info-producto');
    const resumenMovimiento = document.getElementById('resumen-movimiento');
    
    // Motivos sugeridos por tipo
    const motivosSugeridos = {
        entrada: [
            'Compra a proveedor',
            'Inventario inicial',
            'Devolución de cliente',
            'Ajuste por conteo',
            'Producción interna'
        ],
        salida: [
            'Venta a cliente',
            'Producto dañado',
            'Devolución a proveedor',
            'Muestra gratuita',
            'Uso interno'
        ],
        ajuste: [
            'Conteo físico',
            'Corrección de error',
            'Producto encontrado',
            'Producto perdido',
            'Ajuste de sistema'
        ]
    };
    
    function actualizarInfoProducto() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        
        if (productoSelect.value) {
            const codigo = selectedOption.textContent.match(/\[(.*?)\]/)[1];
            const nombre = selectedOption.textContent.split('] ')[1].split(' (Stock:')[0];
            const stock = selectedOption.dataset.stock;
            const unidad = selectedOption.dataset.unidad;
            const precioCompra = selectedOption.dataset.precioCompra;
            const precioVenta = selectedOption.dataset.precioVenta;
            
            document.getElementById('producto-codigo').textContent = codigo;
            document.getElementById('producto-nombre').textContent = nombre;
            document.getElementById('producto-stock').textContent = stock;
            document.getElementById('producto-unidad').textContent = unidad;
            document.getElementById('producto-precio-compra').textContent = parseFloat(precioCompra).toFixed(2);
            document.getElementById('producto-precio-venta').textContent = parseFloat(precioVenta).toFixed(2);
            
            document.getElementById('unidad-medida').textContent = `Unidad: ${unidad}`;
            document.getElementById('stock-disponible').textContent = ` | Stock disponible: ${stock}`;
            
            infoProducto.style.display = 'block';
            
            // Sugerir precio según el tipo de movimiento
            actualizarPrecioSugerido();
            calcularNuevoStock();
        } else {
            infoProducto.style.display = 'none';
            resumenMovimiento.style.display = 'none';
        }
    }
    
    function actualizarPrecioSugerido() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const tipo = tipoSelect.value;
        
        if (selectedOption && tipo) {
            let precioSugerido = '';
            
            switch(tipo) {
                case 'entrada':
                    precioSugerido = selectedOption.dataset.precioCompra;
                    break;
                case 'salida':
                    precioSugerido = selectedOption.dataset.precioVenta;
                    break;
                case 'ajuste':
                    precioSugerido = selectedOption.dataset.precioCompra;
                    break;
            }
            
            if (precioSugerido && !precioInput.value) {
                precioInput.value = parseFloat(precioSugerido).toFixed(2);
            }
        }
    }
    
    function actualizarMotivosSugeridos() {
        const tipo = tipoSelect.value;
        const contenedor = document.getElementById('motivos-sugeridos');
        
        contenedor.innerHTML = '';
        
        if (tipo && motivosSugeridos[tipo]) {
            motivosSugeridos[tipo].forEach(motivo => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-suggested';
                btn.textContent = motivo;
                btn.onclick = () => {
                    motivoInput.value = motivo;
                };
                contenedor.appendChild(btn);
            });
        }
    }
    
    function calcularNuevoStock() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const tipo = tipoSelect.value;
        const cantidad = parseInt(cantidadInput.value) || 0;
        
        if (selectedOption && tipo && cantidad > 0) {
            const stockActual = parseInt(selectedOption.dataset.stock);
            let nuevoStock = stockActual;
            
            switch(tipo) {
                case 'entrada':
                    nuevoStock = stockActual + cantidad;
                    break;
                case 'salida':
                    nuevoStock = stockActual - cantidad;
                    break;
                case 'ajuste':
                    nuevoStock = cantidad; // En ajuste, la cantidad es el nuevo stock total
                    break;
            }
            
            const stockResultado = document.getElementById('stock-resultado');
            const nuevoStockSpan = document.getElementById('nuevo-stock');
            
            nuevoStockSpan.textContent = `${nuevoStock} ${selectedOption.dataset.unidad}`;
            
            if (nuevoStock < 0) {
                stockResultado.className = 'stock-alert alert-danger';
                nuevoStockSpan.innerHTML += ' <i class="fas fa-exclamation-triangle"></i> Stock insuficiente';
            } else if (nuevoStock === 0) {
                stockResultado.className = 'stock-alert alert-warning';
            } else {
                stockResultado.className = 'stock-alert alert-success';
            }
            
            stockResultado.style.display = 'block';
        } else {
            document.getElementById('stock-resultado').style.display = 'none';
        }
    }
    
    function actualizarResumen() {
        const tipo = tipoSelect.value;
        const cantidad = parseInt(cantidadInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        
        if (tipo && cantidad > 0) {
            const tipoTexto = {
                'entrada': '<span class="badge badge-success movement-badge">Entrada</span>',
                'salida': '<span class="badge badge-danger movement-badge">Salida</span>',
                'ajuste': '<span class="badge badge-warning movement-badge">Ajuste</span>'
            };
            
            document.getElementById('resumen-tipo').innerHTML = tipoTexto[tipo] || '-';
            document.getElementById('resumen-cantidad').textContent = cantidad;
            document.getElementById('resumen-precio').textContent = precio.toFixed(2);
            document.getElementById('resumen-total').textContent = (cantidad * precio).toFixed(2);
            
            resumenMovimiento.style.display = 'block';
        } else {
            resumenMovimiento.style.display = 'none';
        }
    }
    
    // Event listeners
    productoSelect.addEventListener('change', actualizarInfoProducto);
    tipoSelect.addEventListener('change', function() {
        actualizarPrecioSugerido();
        actualizarMotivosSugeridos();
        calcularNuevoStock();
        actualizarResumen();
    });
    cantidadInput.addEventListener('input', function() {
        calcularNuevoStock();
        actualizarResumen();
    });
    precioInput.addEventListener('input', actualizarResumen);
    
    // Validación del formulario
    document.getElementById('movimiento-form').addEventListener('submit', function(e) {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const tipo = tipoSelect.value;
        const cantidad = parseInt(cantidadInput.value) || 0;
        
        if (tipo === 'salida' && selectedOption) {
            const stockActual = parseInt(selectedOption.dataset.stock);
            if (cantidad > stockActual) {
                e.preventDefault();
                alert(`No puedes sacar ${cantidad} unidades. Solo hay ${stockActual} disponibles.`);
                cantidadInput.focus();
                return false;
            }
        }
    });
    
    // Inicializar si hay producto preseleccionado
    if (productoSelect.value) {
        actualizarInfoProducto();
    }
});
</script>
@endsection