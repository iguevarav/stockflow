<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistema de Inventario')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados del sistema -->
    <style>
        /* Variables de color para sistema de inventarios */
        :root {
            --primary-blue: #2c5aa0;
            --primary-blue-light: #3d6bb7;
            --secondary-dark: #1e3a5f;
            --accent-green: #27ae60;
            --warning-orange: #f39c12;
            --danger-red: #e74c3c;
            --info-cyan: #17a2b8;
            --light-gray: #f8f9fa;
            --dark-gray: #2c3e50;
            --border-color: #dce6f0;
            --text-primary: #2c3e50;
            --text-secondary: #5d6d7e;
            --white: #ffffff;
            --shadow-light: rgba(44, 90, 160, 0.08);
            --shadow-medium: rgba(44, 90, 160, 0.15);
            --navbar-height: 60px;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 60px;
        }

        /* Reset y base */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            line-height: 1.6;
            color: var(--text-primary);
        }

        /* Layout principal */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark-gray) 0%, #34495e 100%);
            box-shadow: 2px 0 15px var(--shadow-light);
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-brand {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar-brand:hover {
            background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-blue) 100%);
            color: white;
            text-decoration: none;
        }

        .brand-icon {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .brand-text {
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .brand-icon {
            margin-right: 0;
        }

        /* Navegación del sidebar */
        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #ecf0f1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            color: white;
            box-shadow: 0 2px 15px var(--shadow-medium);
            transform: translateX(5px);
        }

        .nav-icon {
            margin-right: 0.75rem;
            width: 1.2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .nav-text {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .nav-icon {
            margin-right: 0;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
            padding: 0.75rem 0.5rem;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header superior */
        .top-navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-dark) 100%);
            height: var(--navbar-height);
            box-shadow: 0 2px 15px var(--shadow-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            color: white;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 0.5rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: white;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .user-menu:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        /* Content Header */
        .content-header {
            background: white;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 2px 15px var(--shadow-light);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }

        .content-header h1 {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
        }

        .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 0.5rem;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
            font-weight: 500;
        }

        .breadcrumb-item a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--secondary-dark);
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: '/';
            margin-right: 0.5rem;
            color: var(--text-secondary);
        }

        /* Contenido */
        .content-wrapper {
            flex: 1;
            padding: 1.5rem;
        }

        /* Alertas mejoradas */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid var(--accent-green);
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid var(--danger-red);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border-left: 4px solid var(--warning-orange);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-left: 4px solid var(--info-cyan);
        }

        .alert-dismissible .btn-close {
            background: none;
            border: none;
            opacity: 0.7;
            transition: all 0.2s ease;
            margin-left: auto;
        }

        .alert-dismissible .btn-close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-gray) 0%, #34495e 100%);
            color: #ecf0f1;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 1.5rem;
            margin-top: auto;
        }

        .footer strong {
            color: white;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Contenedor principal del sistema */
        .main-container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Tarjetas de estadísticas */
        .stat-card {
            background: linear-gradient(135deg, var(--white) 0%, #f8f9fa 100%);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 15px var(--shadow-light);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px var(--shadow-medium);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-blue);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, var(--accent-green) 0%, #2ecc71 100%);
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, var(--warning-orange) 0%, #e67e22 100%);
        }

        .stat-icon.value {
            background: linear-gradient(135deg, var(--info-cyan) 0%, #3498db 100%);
        }

        .stat-content h4 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-primary);
        }

        .stat-content p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
            font-weight: 500;
        }

        /* Tarjetas del inventario */
        .inventory-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 15px var(--shadow-light);
            border: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .inventory-card:hover {
            box-shadow: 0 4px 20px var(--shadow-medium);
        }

        /* Header de filtros */
        .filter-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Formularios del inventario */
        .form-label-inventory {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control-inventory {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: var(--white);
            width: 100%;
        }

        .form-control-inventory:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            outline: none;
        }

        /* Contenedor de búsqueda */
        .search-input-container {
            position: relative;
        }

        .search-input {
            padding-left: 2.5rem;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Botones del inventario */
        .btn-inventory {
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .btn-primary-inventory {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            color: white;
        }

        .btn-primary-inventory:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(44, 90, 160, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-light-inventory {
            background: #f8f9fa;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-light-inventory:hover {
            background: #e9ecef;
            color: var(--text-primary);
            text-decoration: none;
        }

        /* Badges del inventario */
        .badge-inventory {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-category {
            background: #e3f2fd;
            color: #1565c0;
        }

        .badge-active {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .badge-stock-good {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .badge-stock-danger {
            background: #ffebee;
            color: #c62828;
        }

        /* Tabla del inventario */
        .table-inventory {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .table-inventory th {
            background: #f8f9fa;
            padding: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 2px solid var(--border-color);
            text-align: left;
            font-size: 0.9rem;
        }

        .table-inventory td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .table-inventory tbody tr:hover {
            background: #f8f9fa;
        }

        /* Información del producto */
        .product-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .product-avatar {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .product-details h5 {
            margin: 0 0 0.25rem 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .product-code {
            background: #f0f0f0;
            color: var(--text-secondary);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-description {
            margin: 0.25rem 0 0 0;
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.3;
        }

        /* Información de stock */
        .stock-info {
            text-align: center;
        }

        .stock-min {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        /* Información de precios */
        .price-info {
            text-align: right;
        }

        .price-buy {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .price-sell {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0.15rem 0;
        }

        .profit-margin {
            font-size: 0.75rem;
            color: var(--accent-green);
            font-weight: 600;
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action.view {
            background: #e3f2fd;
            color: #1565c0;
        }

        .btn-action.edit {
            background: #fff3e0;
            color: #ef6c00;
        }

        .btn-action.move {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .btn-action.delete {
            background: #ffebee;
            color: #c62828;
        }

        .btn-action:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: inherit;
        }

        /* Scrollbar personalizado */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Efectos de carga */
        .app-wrapper {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estados hover para mejor UX */
        .inventory-card,
        .stat-card,
        .alert {
            transition: all 0.3s ease;
        }

        .inventory-card:hover,
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px var(--shadow-medium);
        }

        /* Responsive para tablets */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .content-header {
                padding: 1rem;
                margin-bottom: 1rem;
            }
            
            .content-header h1 {
                font-size: 1.3rem;
            }
            
            .brand-text {
                font-size: 1rem;
            }
        }

        /* Responsive para móviles */
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
            
            .navbar-right .user-menu {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        /* Overlay para móviles */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Text utilities */
        .text-md {
            font-size: 1.1rem;
        }

        .text-primary {
            color: var(--primary-blue) !important;
        }

        .text-secondary {
            color: var(--text-secondary) !important;
        }

        .text-success {
            color: var(--accent-green) !important;
        }

        .text-warning {
            color: var(--warning-orange) !important;
        }

        .text-danger {
            color: var(--danger-red) !important;
        }

        /* Display utilities */
        .d-flex {
            display: flex !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .gap-1 {
            gap: 0.25rem !important;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        .gap-3 {
            gap: 1rem !important;
        }

        /* Margin utilities */
        .mb-0 { margin-bottom: 0 !important; }
        .mb-1 { margin-bottom: 0.25rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }

        .mr-1 { margin-right: 0.25rem !important; }
        .mr-2 { margin-right: 0.5rem !important; }
        .mr-3 { margin-right: 1rem !important; }

        .ml-auto { margin-left: auto !important; }

        /* Padding utilities */
        .p-0 { padding: 0 !important; }
        .p-1 { padding: 0.25rem !important; }
        .p-2 { padding: 0.5rem !important; }
        .p-3 { padding: 1rem !important; }

        /* Container fluid mejorado */
        .container-fluid {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    <!-- Enlace al archivo CSS personalizado del sistema -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @stack('styles')
</head>

<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="sidebar-brand">
                <i class="fas fa-boxes brand-icon"></i>
                <span class="brand-text">Sistema Inventario</span>
            </a>

            <!-- Sidebar Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ url('/categorias') }}" class="nav-link {{ request()->is('categorias*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <span class="nav-text">Categorías</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ url('/productos') }}" class="nav-link {{ request()->is('productos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <span class="nav-text">Productos</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ url('/movimientos') }}" class="nav-link {{ request()->is('movimientos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <span class="nav-text">Movimientos</span>
                    </a>
                </div>

                @yield('sidebar-menu')
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <div class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="navbar-right">
                    <a href="#" class="user-menu">
                        <i class="fas fa-user"></i>
                        <span>Usuario</span>
                    </a>
                </div>
            </nav>

            <!-- Content Header -->
            <div class="content-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1>@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Mostrar mensajes de sesión -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <strong>¡Éxito!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>¡Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>¡Atención!</strong> {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong>¡Información!</strong> {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="footer-content">
                    <div>
                        <strong>
                            <i class="fas fa-boxes mr-2"></i>
                            Sistema de Inventario © {{ date('Y') }}
                        </strong>
                        - Gestión Inteligente de Inventarios
                    </div>
                    <div>
                        <b>Versión</b> 1.0.0
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Overlay para móviles -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personalizados -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        // Mobile behavior
                        sidebar.classList.toggle('show');
                        sidebarOverlay.classList.toggle('show');
                    } else {
                        // Desktop behavior
                        sidebar.classList.toggle('collapsed');
                    }
                });
            }

            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Auto-hide alerts después de 5 segundos
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });

            // Close alert buttons functionality
            document.querySelectorAll('.btn-close').forEach(function(button) {
                button.addEventListener('click', function() {
                    const alert = this.closest('.alert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.3s ease';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 300);
                    }
                });
            });

            // Add smooth scrolling to navigation links
            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    // Close mobile sidebar when clicking navigation link
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>