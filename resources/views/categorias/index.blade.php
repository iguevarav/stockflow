@extends('layouts.app')

@section('title', 'Categorías - Sistema de Inventario')
@section('page-title', 'Gestión de Categorías')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Categorías</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="categories-container">
    <div class="row">
        <div class="col-12">
            <div class="categories-card">
                <div class="categories-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-tags"></i>
                            Lista de Categorías
                        </h3>
                        <a href="{{ route('categorias.create') }}" class="btn-add-category">
                            <i class="fas fa-plus"></i> Añadir Categoría
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($categorias->count() > 0)
                        <div class="table-responsive">
                            <table class="categories-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Categoría</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Fecha Creación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorias as $categoria)
                                    <tr>
                                        <td>
                                            <span class="category-id">{{ $categoria->id }}</span>
                                        </td>
                                        <td>
                                            <div class="category-info">
                                                <div class="category-avatar">
                                                    {{ strtoupper(substr($categoria->nombre, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="category-name">{{ $categoria->nombre }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="category-description {{ $categoria->descripcion ? '' : 'empty' }}">
                                                {{ $categoria->descripcion ?? 'Sin descripción' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="products-badge">
                                                {{ $categoria->productos_count }} producto{{ $categoria->productos_count != 1 ? 's' : '' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="category-date">{{ $categoria->created_at->format('d/m/Y') }}</div>
                                            <div class="category-date" style="font-size: 0.7rem; opacity: 0.7;">
                                                {{ $categoria->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('categorias.show', $categoria) }}" 
                                                   class="btn-action view" title="Ver categoría">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('categorias.edit', $categoria) }}" 
                                                   class="btn-action edit" title="Editar categoría">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('categorias.destroy', $categoria) }}" 
                                                      method="POST" style="display: inline;" 
                                                      onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete" title="Eliminar categoría">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación -->
                        @if($categorias->hasPages())
                        <div class="pagination-wrapper">
                            {{ $categorias->links() }}
                        </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h5>No hay categorías registradas</h5>
                            <p>Crea tu primera categoría para organizar tus productos de manera eficiente.</p>
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Crear Primera Categoría
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection