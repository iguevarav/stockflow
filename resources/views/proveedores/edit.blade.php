@extends('layouts.app')

@section('title', 'Editar Proveedor - Sistema de Inventario')
@section('page-title', 'Editar Proveedor')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection


@section('content')

<style>
.container-custom {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Header de edición */
.edit-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 24px;
    color: white;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
}

.edit-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.edit-header p {
    margin: 8px 0 0 0;
    opacity: 0.9;
    font-size: 14px;
}

/* Contenedor del formulario */
.form-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    margin-bottom: 24px;
}

/* Footer de acciones */
.actions-footer {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.required-note {
    color: #f59e0b;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.required-note::before {
    content: "⚠️";
    font-size: 16px;
}

/* Botones de acción */
.actions-group {
    display: flex;
    gap: 12px;
    align-items: center;
}

.btn-volver {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 14px;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
    cursor: pointer;
}

.btn-volver:hover {
    background: linear-gradient(135deg, #4b5563, #374151);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
}

.btn-actualizar {
    background: linear-gradient(135deg, #10b981, #059669);
    border: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 14px;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    cursor: pointer;
}

.btn-actualizar:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

/* Estados de botones */
.btn-actualizar:disabled {
    background: #d1d5db;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-actualizar:disabled:hover {
    background: #d1d5db;
    transform: none;
    box-shadow: none;
}

/* Animación de carga */
.btn-loading {
    position: relative;
    pointer-events: none;
}

.btn-loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    margin: auto;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsivo */
@media (max-width: 768px) {
    .container-custom {
        padding: 16px;
    }
    
    .actions-footer {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .actions-group {
        width: 100%;
        justify-content: center;
    }
    
    .btn-volver,
    .btn-actualizar {
        flex: 1;
        justify-content: center;
        min-width: 120px;
    }
    
    .edit-header h3 {
        font-size: 18px;
    }
}

/* Transiciones suaves */
* {
    transition: all 0.3s ease;
}

/* Focus states mejorados */
button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}
</style>

<div class="container-custom">
    
    <!-- Header de edición -->
    <div class="edit-header">
        <h3>
            <i class="fas fa-edit"></i> 
            Editar Proveedor
        </h3>
        <p>Modifica la información del proveedor seleccionado</p>
    </div>

    <!-- Contenedor del formulario -->
    <div class="form-container">
        @include('proveedores.forms.form_edit_proveedor')
    </div>

    <!-- Footer de acciones -->
    <div class="actions-footer">
        <div class="required-note">
            Los campos con * son obligatorios
        </div>

        <div class="actions-group">
            <button class="btn-volver" type="button" id="btnVolver">
                <i class="fas fa-arrow-left"></i> VOLVER
            </button>
            <button class="btn-actualizar" type="submit" form="formActualizarProveedor" id="btnActualizar">
                <i class="fas fa-save"></i> ACTUALIZAR
            </button>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnVolver = document.getElementById('btnVolver');
    const btnActualizar = document.getElementById('btnActualizar');
    const form = document.getElementById('formActualizarProveedor');

    // Botón volver
    btnVolver.addEventListener('click', function() {
        if (confirm('¿Estás seguro de salir? Los cambios no guardados se perderán.')) {
            window.location.href = "{{ route('proveedores.index') }}";
        }
    });

    // Efecto de carga en botón actualizar
    if (form) {
        form.addEventListener('submit', function() {
            btnActualizar.classList.add('btn-loading');
            btnActualizar.disabled = true;
            btnActualizar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ACTUALIZANDO...';
        });
    }

    // Detectar cambios en el formulario
    let formChanged = false;
    if (form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('change', function() {
                formChanged = true;
            });
        });
    }

    // Confirmar salida si hay cambios
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
});
</script>
@endsection