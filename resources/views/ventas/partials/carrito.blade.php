<div class="card mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-box"></i> Productos</h5>
        <button type="button" class="btn btn-sm btn-success" onclick="agregarProducto()">
            <i class="fas fa-plus"></i> Agregar Producto
        </button>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0" id="tabla-productos">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th style="width: 120px">Cantidad</th>
                    <th style="width: 150px">Precio Venta</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($detalles))
                @foreach($detalles as $i => $detalle)
                <tr>
                    <td>
                        <select name="productos[{{ $i }}][producto_id]" class="form-control producto-select" required>
                            <option value="">Seleccione</option>
                            @foreach($productos as $producto)
                            <option value="{{ $producto->id }}"
                                data-precio="{{ $producto->precio_venta }}"
                                {{ $producto->id == $detalle->producto_id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="productos[{{ $i }}][cantidad]" class="form-control cantidad" value="{{ $detalle->cantidad }}" required min="1">
                    </td>
                    <td>
                        <input type="number" name="productos[{{ $i }}][precio_venta]" class="form-control precio" value="{{ $detalle->precio_venta }}" required step="0.01" min="0">
                    </td>
                    <td class="subtotal text-end pt-2">S/. {{ number_format($detalle->subtotal, 2) }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end">
        <h5 class="mb-0">Total: <span id="total-general">S/. 0.00</span></h5>
    </div>

</div>

<script>
    let contador = {{ isset($detalles) ? count($detalles) : 0 }};
    const productosDisponibles = @json($productos);

    function agregarProducto() {
        const table = document.getElementById('tabla-productos').getElementsByTagName('tbody')[0];
        const row = table.insertRow();

        row.innerHTML = `
            <td>
                <select name="productos[${contador}][producto_id]" class="form-control producto-select" required>
                    <option value="">Seleccione</option>
                    ${productosDisponibles.map(p => `<option value="${p.id}" data-precio="${p.precio_venta}">${p.nombre}</option>`).join('')}
                </select>
            </td>
            <td>
                <input type="number" name="productos[${contador}][cantidad]" class="form-control cantidad" value="1" min="1" required>
            </td>
            <td>
                <input type="number" name="productos[${contador}][precio_venta]" class="form-control precio" value="0.00" step="0.01" min="0" required>
            </td>
            <td class="subtotal text-end pt-2">S/. 0.00</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;

        contador++;
        actualizarTotal();
    }

    function eliminarFila(btn) {
        const row = btn.closest('tr');
        row.remove();
        actualizarTotal();
    }

    function actualizarSubtotalYTotal(row) {
        const cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
        const precio = parseFloat(row.querySelector('.precio').value) || 0;
        const subtotal = cantidad * precio;
        row.querySelector('.subtotal').textContent = 'S/. ' + subtotal.toFixed(2);

        actualizarTotal();
    }

    function actualizarTotal() {
        let total = 0;
        document.querySelectorAll('#tabla-productos tbody tr').forEach(row => {
            const cantidad = parseFloat(row.querySelector('.cantidad')?.value) || 0;
            const precio = parseFloat(row.querySelector('.precio')?.value) || 0;
            total += cantidad * precio;
        });
        document.getElementById('total-general').textContent = 'S/. ' + total.toFixed(2);
    }

    document.addEventListener('input', function (event) {
        if (event.target.classList.contains('cantidad') || event.target.classList.contains('precio')) {
            const row = event.target.closest('tr');
            actualizarSubtotalYTotal(row);
        }
    });

    document.addEventListener('change', function (event) {
        if (event.target.classList.contains('producto-select')) {
            const row = event.target.closest('tr');
            const selectedOption = event.target.selectedOptions[0];
            const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;

            const precioInput = row.querySelector('.precio');
            precioInput.value = precio.toFixed(2);

            actualizarSubtotalYTotal(row);
        }
    });

    // Inicializar total al cargar si hay productos prellenados
    document.addEventListener('DOMContentLoaded', actualizarTotal);
</script>
