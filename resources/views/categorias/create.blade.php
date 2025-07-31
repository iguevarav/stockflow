@extends('layouts.app')

@section('title', 'Nueva Categoría - Sistema de Inventario')
@section('page-title', 'Nueva Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorías</a></li>
<li class="breadcrumb-item active">Nueva</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section('content')
<div class="form-container">
    <div class="row">
        <div class="col-md-8">
            <div class="form-card">
                <div class="form-header">
                    <h3 class="card-title ">
                        <i class="fas fa-plus"></i>
                        Crear Nueva Categoría
                    </h3>
                </div>
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control form-input @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}" 
                                   placeholder="Ingrese el nombre de la categoría"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control form-input @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      placeholder="Descripción opcional de la categoría">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary form-btn">
                            <i class="fas fa-save"></i> Guardar Categoría
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary form-btn">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="info-card">
                <div class="info-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Información
                    </h3>
                </div>
                <div class="card-body">
                    <h6 class="section-title">Consejos para crear categorías:</h6>
                    <ul class="tips-list">
                        <li><i class="fas fa-check text-success"></i> Usa nombres descriptivos y claros</li>
                        <li><i class="fas fa-check text-success"></i> Evita nombres muy largos</li>
                        <li><i class="fas fa-check text-success"></i> Agrupa productos similares</li>
                        <li><i class="fas fa-check text-success"></i> La descripción es opcional pero recomendada</li>
                    </ul>
                    
                    <hr class="section-divider">
                    
                    <h6 class="section-title">Ejemplos de categorías:</h6>
                    <div class="example-badges">
                        <span class="badge badge-primary example-badge">Electrónicos</span>
                        <span class="badge badge-success example-badge">Ropa</span>
                        <span class="badge badge-info example-badge">Hogar</span>
                        <span class="badge badge-warning example-badge">Deportes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection