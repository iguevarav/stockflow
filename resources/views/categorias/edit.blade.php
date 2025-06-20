@extends('layouts.app')

@section('title', 'Editar Categoría - Sistema de Inventario')
@section('page-title', 'Editar Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="edit-container">
    <div class="row">
        <div class="col-md-8">
            <div class="edit-card">
                <div class="edit-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Editar Categoría: <span class="current-name">{{ $categoria->nombre }}</span>
                    </h3>
                </div>
                <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="edit-form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control edit-input @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $categoria->nombre) }}" 
                                   placeholder="Ingrese el nombre de la categoría"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="edit-form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control edit-input @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      placeholder="Descripción opcional de la categoría">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="edit-footer">
                        <button type="submit" class="btn btn-primary edit-btn">
                            <i class="fas fa-save"></i> Actualizar Categoría
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary edit-btn">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-info edit-btn">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="edit-card">
                <div class="info-header-edit">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Información de la Categoría
                    </h3>
                </div>
                <div class="card-body">
                    <table class="info-table">
                        <tr>
                            <th>ID:</th>
                            <td>
                                <span class="id-badge">{{ $categoria->id }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Creada:</th>
                            <td>
                                <div class="date-value">{{ $categoria->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $categoria->created_at->format('H:i') }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Actualizada:</th>
                            <td>
                                <div class="date-value">{{ $categoria->updated_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $categoria->updated_at->format('H:i') }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Productos:</th>
                            <td>
                                <span class="info-badge">
                                    {{ $categoria->productos()->count() }} producto{{ $categoria->productos()->count() != 1 ? 's' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection