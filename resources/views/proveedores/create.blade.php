@extends('layouts.app')

@section('title', 'Nuevo Proveedor - Sistema de Inventario')
@section('page-title', 'Nuevo Proveedor')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
<li class="breadcrumb-item active">Nuevo</li>
@endsection



@section('content')

<style>
/* === CREATE PROVEEDOR - ESTILO PREMIUM === */

.container-custom {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Header de creación */
.create-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 24px;
    color: white;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
}

.create-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.create-header p {
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

.btn-registrar {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
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
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
    cursor: pointer;
}

.btn-registrar:hover {
    background: linear-gradient(135deg, #4338ca, #3730a3);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
}

/* Estados de botones */
.btn-registrar:disabled {
    background: #d1d5db;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-registrar:disabled:hover {
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

/* Indicador de progreso de formulario */
.form-progress {
    background: rgba(255, 255, 255, 0.2);
    height: 4px;
    border-radius: 2px;
    margin-top: 16px;
    overflow: hidden;
}

.form-progress-bar {
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    width: 0%;
    transition: width 0.3s ease;
    border-radius: 2px;
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
    .btn-registrar {
        flex: 1;
        justify-content: center;
        min-width: 120px;
    }
    
    .create-header h3 {
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

/* Efecto de éxito */
.success-animation {
    animation: successPulse 0.6s ease-in-out;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>

<div class="container-custom">
    
    <!-- Header de creación -->
    <div class="create-header">
        <h3>
            <i class="fas fa-plus-circle"></i> 
            Nuevo Proveedor
        </h3>
        <p>Registra un nuevo proveedor en el sistema</p>
        
        <!-- Barra de progreso del formulario -->
        <div class="form-progress">
            <div class="form-progress-bar" id="formProgress"></div>
        </div>
    </div>

    <!-- Contenedor del formulario -->
    <div class="form-container">
        @include('proveedores.forms.form_create_proveedor')
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
            <button class="btn-registrar" type="submit" form="formRegistrarProveedor" id="btnRegistrar">
                <i class="fas fa-save"></i> REGISTRAR
            </button>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnVolver = document.getElementById('btnVolver');
    const btnRegistrar = document.getElementById('btnRegistrar');
    const form = document.getElementById('formRegistrarProveedor');
    const progressBar = document.getElementById('formProgress');

    // Botón volver
    btnVolver.addEventListener('click', function() {
        if (hasFormData()) {
            if (confirm('¿Estás seguro de salir? Los datos ingresados se perderán.')) {
                window.location.href = "{{ route('proveedores.index') }}";
            }
        } else {
            window.location.href = "{{ route('proveedores.index') }}";
        }
    });

    // Efecto de carga en botón registrar
    if (form) {
        form.addEventListener('submit', function(e) {
            btnRegistrar.classList.add('btn-loading');
            btnRegistrar.disabled = true;
            btnRegistrar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> REGISTRANDO...';
            
            // Simular progreso completo
            progressBar.style.width = '100%';
        });
    }

    // Detectar si hay datos en el formulario
    function hasFormData() {
        if (!form) return false;
        
        const inputs = form.querySelectorAll('input, select, textarea');
        for (let input of inputs) {
            if (input.type !== 'hidden' && input.value.trim() !== '') {
                return true;
            }
        }
        return false;
    }

    // Actualizar barra de progreso basada en campos completados
    function updateProgress() {
        if (!form) return;
        
        const requiredInputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        const filledInputs = Array.from(requiredInputs).filter(input => input.value.trim() !== '');
        
        const progress = (filledInputs.length / requiredInputs.length) * 100;
        progressBar.style.width = progress + '%';
        
        // Habilitar/deshabilitar botón según progreso
        if (progress === 100) {
            btnRegistrar.disabled = false;
            btnRegistrar.classList.add('success-animation');
            setTimeout(() => btnRegistrar.classList.remove('success-animation'), 600);
        } else {
            btnRegistrar.disabled = false; // Permitir envío para mostrar errores de validación
        }
    }

    // Escuchar cambios en el formulario
    if (form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('change', updateProgress);
        });
        
        // Progreso inicial
        updateProgress();
    }

    // Confirmar salida si hay datos
    window.addEventListener('beforeunload', function(e) {
        if (hasFormData()) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Efecto de éxito en validación
    if (form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity() && this.value.trim() !== '') {
                    this.style.borderColor = '#10b981';
                    this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
                }
            });
            
            input.addEventListener('focus', function() {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            });
        });
    }
});
</script>
@endsection