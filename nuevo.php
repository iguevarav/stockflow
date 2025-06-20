<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos - Sistema de Inventario</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados del sistema -->
    <style>
        /* Variables de color para sistema de inventarios */
        :root {
            --inventory-primary: #2c5aa0;
            --inventory-primary-light: #3d6bb7;
            --inventory-secondary: #1e3a5f;
            --inventory-success: #27ae60;
            --inventory-warning: #f39c12;
            --inventory-danger: #e74c3c;
            --inventory-info: #17a2b8;
            --inventory-light: #f8f9fa;
            --inventory-dark: #2c3e50;
            --inventory-border: #dce6f0;
            --inventory-text: #2c3e50;
            --inventory-text-muted: #5d6d7e;
            --inventory-shadow: rgba(44, 90, 160, 0.08);
            --inventory-shadow-hover: rgba(44, 90, 160, 0.15);
        }

        /* Override AdminLTE defaults */
        .main-header.navbar {
            background: linear-gradient(135deg, var(--inventory-primary) 0%, var(--inventory-secondary) 100%) !important;
            border: none !important;
            box-shadow: 0 2px 15px var(--inventory-shadow) !important;
        }

        .main-header.navbar .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .main-header.navbar .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
            transform: translateY(-1px);
        }

        /* Sidebar mejorado */
        .main-sidebar {
            background: linear-gradient(180deg, var(--inventory-dark) 0%, #34495e 100%) !important;
            box-shadow: 2px 0 15px var(--inventory-shadow) !important;
        }

        .brand-link {
            background: linear-gradient(135deg, var(--inventory-primary) 0%, var(--inventory-primary-light) 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            padding: 1rem 1.25rem !important;
            transition: all 0.3s ease;
        }

        .brand-link:hover {
            background: linear-gradient(135deg, var(--inventory-secondary) 0%, var(--inventory-primary) 100%) !important;
            color: white !important;
            text-decoration: none;
        }

        .brand-text {
            font-weight: 600 !important;
            font-size: 1.1rem !important;
            margin-left: 0.5rem !important;
        }

        .brand-image {
            font-size: 1.5rem !important;
            margin-right: 0.5rem !important;
        }

        /* Menu items mejorados */
        .nav-sidebar .nav-item .nav-link {
            color: #ecf0f1 !important;
            padding: 0.75rem 1rem !important;
            margin: 0.25rem 0.5rem !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            font-weight: 500 !important;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transform: translateX(5px) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: linear-gradient(135deg, var(--inventory-primary) 0%, var(--inventory-primary-light) 100%) !important;
            color: white !important;
            box-shadow: 0 2px 15px var(--inventory-shadow-hover) !important;
            transform: translateX(5px) !important;
        }

        .nav-sidebar .nav-item .nav-link .nav-icon {
            margin-right: 0.75rem !important;
            width: 1.2rem !important;
            text-align: center !important;
        }

        /* Content wrapper mejorado */
        .content-wrapper {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
            min-height: calc(100vh - 3.5rem) !important;
        }

        /* Content header mejorado */
        .content-header {
            background: white !important;
            border-radius: 0 0 15px 15px !important;
            box-shadow: 0 2px 15px var(--inventory-shadow) !important;
            margin-bottom: 1.5rem !important;
            padding: 1.5rem 1rem !important;
        }

        .content-header h1 {
            color: var(--inventory-text) !important;
            font-weight: 600 !important;
            font-size: 1.5rem !important;
            margin: 0 !important;
        }

        .breadcrumb {
            background: transparent !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .breadcrumb-item a {
            color: var(--inventory-primary) !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .breadcrumb-item a:hover {
            color: var(--inventory-secondary) !important;
        }

        .breadcrumb-item.active {
            color: var(--inventory-text-muted) !important;
            font-weight: 500 !important;
        }

        /* Footer mejorado */
        .main-footer {
            background: linear-gradient(135deg, var(--inventory-dark) 0%, #34495e 100%) !important;
            color: #ecf0f1 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1rem !important;
            margin-top: 2rem !important;
        }

        .main-footer strong {
            color: white !important;
        }

        /* Alertas mejoradas */
        .alert {
            border: none !important;
            border-radius: 10px !important;
            padding: 1rem 1.25rem !important;
            margin-bottom: 1.5rem !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%) !important;
            color: #155724 !important;
            border-left: 4px solid var(--inventory-success) !important;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%) !important;
            color: #721c24 !important;
            border-left: 4px solid var(--inventory-danger) !important;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%) !important;
            color: #856404 !important;
            border-left: 4px solid var(--inventory-warning) !important;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%) !important;
            color: #0c5460 !important;
            border-left: 4px solid var(--inventory-info) !important;
        }

        .btn-close {
            background: none !important;
            opacity: 0.7 !important;
            transition: all 0.2s ease !important;
        }

        .btn-close:hover {
            opacity: 1 !important;
            transform: scale(1.1) !important;
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
        .wrapper {
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

        /* Pushmenu button mejorado */
        .navbar-nav .nav-link[data-widget="pushmenu"] {
            padding: 0.5rem 0.75rem !important;
            border-radius: 6px !important;
            transition: all 0.2s ease !important;
        }

        .navbar-nav .nav-link[data-widget="pushmenu"]:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            transform: scale(1.05) !important;
        }

        /* User menu mejorado */
        .navbar-nav .nav-item:last-child .nav-link {
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 20px !important;
            padding: 0.5rem 1rem !important;
            margin-left: 0.5rem !important;
        }

        .navbar-nav .nav-item:last-child .nav-link:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-1px) !important;
        }

        /* Container fluid mejorado */
        .container-fluid {
            max-width: 90% !important;
            margin: 0 auto !important;
        }

        /* Responsive mejoras */
        @media (max-width: 768px) {
            .container-fluid {
                max-width: 95% !important;
            }

            .content-header {
                padding: 1rem !important;
                margin-bottom: 1rem !important;
            }

            .content-header h1 {
                font-size: 1.3rem !important;
            }

            .brand-text {
                font-size: 1rem !important;
            }
        }

        /* Mejoras para cuando sidebar está colapsado */
        @media (min-width: 992px) {
            .sidebar-collapse .brand-text {
                display: none !important;
            }

            .sidebar-collapse .nav-sidebar .nav-item .nav-link p {
                display: none !important;
            }

            .sidebar-collapse .nav-sidebar .nav-item .nav-link {
                text-align: center !important;
                padding: 0.75rem 0.5rem !important;
            }
        }

        /* Estados hover para mejor UX */
        .card,
        .info-box,
        .alert {
            transition: all 0.3s ease !important;
        }

        .card:hover,
        .info-box:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 20px var(--inventory-shadow-hover) !important;
        }
    </style>

    <link rel="stylesheet" href="http://127.0.0.1:8000/css/styles.css">
</head>

<body class="sidebar-mini layout-fixed sidebar-open" style="height: auto;">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-user mr-1"></i> Usuario
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="http://127.0.0.1:8000" class="brand-link">
                <i class="fas fa-boxes brand-image"></i>
                <span class="brand-text">Sistema Inventario</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="overflow-y: auto;">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <li class="nav-item">
                            <a href="http://127.0.0.1:8000" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://127.0.0.1:8000/categorias" class="nav-link ">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Categorías</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://127.0.0.1:8000/productos" class="nav-link active">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Productos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://127.0.0.1:8000/movimientos" class="nav-link ">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Movimientos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper" style="min-height: 495.2px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Gestión de Productos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://127.0.0.1:8000">Dashboard</a></li>
                                <li class="breadcrumb-item active">Productos</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">




                    <div class="main-container">
                        <!-- Estadísticas superiores -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon total">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>24</h4>
                                    <p>Total Productos</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon active">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>24</h4>
                                    <p>Productos Activos</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>8</h4>
                                    <p>Stock Bajo</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon value">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>$92,051</h4>
                                    <p>Valor Inventario</p>
                                </div>
                            </div>
                        </div>

                        <!-- Panel de filtros -->
                        <div class="inventory-card">
                            <div class="filter-header">
                                <h3 class="text-md"><i class="fas fa-filter" style="margin-right: 8px;"></i>Filtros de Búsqueda</h3>
                            </div>
                            <div style="padding: 24px;">
                                <form method="GET" action="http://127.0.0.1:8000/productos">
                                    <div class="row">
                                        <div class="col-md-4" style="margin-bottom: 16px;">
                                            <label for="search" class="form-label-inventory">Búsqueda General</label>
                                            <div class="search-input-container">
                                                <i class="fas fa-search search-icon"></i>
                                                <input type="text" class="form-control-inventory search-input" id="search" name="search" value="" placeholder="Nombre, código o descripción...">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 16px;">
                                            <label for="categoria_id" class="form-label-inventory">Categoría</label>
                                            <select class="form-control-inventory" id="categoria_id" name="categoria_id">
                                                <option value="">Todas las categorías</option>
                                                <option value="2">
                                                    Componentes Electrónicos
                                                </option>
                                                <option value="6">
                                                    Herramientas y Equipos
                                                </option>
                                                <option value="3">
                                                    Materiales de Empaque
                                                </option>
                                                <option value="1">
                                                    Materias Primas
                                                </option>
                                                <option value="4">
                                                    Productos Semi-terminados
                                                </option>
                                                <option value="5">
                                                    Productos Terminados
                                                </option>
                                                <option value="7">
                                                    Químicos y Lubricantes
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="margin-bottom: 16px;">
                                            <label for="estado" class="form-label-inventory">Estado</label>
                                            <select class="form-control-inventory" id="estado" name="estado">
                                                <option value="">Todos</option>
                                                <option value="1">Activos</option>
                                                <option value="0">Inactivos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 16px;">
                                            <label class="form-label-inventory">&nbsp;</label>
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="stock_bajo" name="stock_bajo" value="1">
                                                    <label class="form-check-label" for="stock_bajo" style="font-size: 13px; color: var(--text-secondary);">
                                                        Solo stock bajo
                                                    </label>
                                                </div>
                                                <div style="display: flex; gap: 8px;">
                                                    <button type="submit" class="btn-inventory btn-primary-inventory">
                                                        <i class="fas fa-search" style="margin-right: 4px;"></i> Buscar
                                                    </button>
                                                    <a href="http://127.0.0.1:8000/productos" class="btn-inventory btn-light-inventory">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Lista de productos -->
                        <div class="inventory-card">
                            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-color); background: white;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <h3 style="font-size: 18px; font-weight: 600; color: var(--text-primary); margin: 0;">
                                            <i class="fas fa-list" style="margin-right: 8px; color: var(--primary-blue);"></i>
                                            Lista de Productos
                                            <span class="badge-inventory" style="background: var(--accent-green); color: var(--white); margin-left: 8px;">
                                                24 totales
                                            </span>
                                        </h3>
                                    </div>
                                    <a href="http://127.0.0.1:8000/productos/create" class="btn-inventory btn-primary-inventory">
                                        <i class="fas fa-plus" style="margin-right: 4px;"></i> Nuevo Producto
                                    </a>
                                </div>
                            </div>
                            <div style="padding: 0;">
                                <div class="table-responsive">
                                    <table class="table-inventory">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Categoría</th>
                                                <th>Stock</th>
                                                <th>Precios</th>
                                                <th>Estado</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            AC
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Aceite Hidráulico ISO 46</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">QL001</span>
                                                            </div>
                                                            <p class="product-description">Aceite hidráulico para sistemas industriales</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Químicos y Lubricantes
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">180</span>
                                                        <div class="stock-min">
                                                            Mín: 100 l
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $8.50</div>
                                                        <div class="price-sell">$14.25</div>
                                                        <div class="profit-margin">
                                                            +40.4%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/21" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/21/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=21" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/21" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            AC
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Acero Inoxidable 304</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">MP001</span>
                                                            </div>
                                                            <p class="product-description">Lámina de acero inoxidable calibre 18, 1.2mm...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Materias Primas
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">2500</span>
                                                        <div class="stock-min">
                                                            Mín: 500 kg
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $8.50</div>
                                                        <div class="price-sell">$12.75</div>
                                                        <div class="profit-margin">
                                                            +33.3%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/1" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/1/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=1" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/1" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            AL
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Aluminio 6061-T6</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">MP003</span>
                                                            </div>
                                                            <p class="product-description">Barra de aluminio extruido para mecanizado</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Materias Primas
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">850</span>
                                                        <div class="stock-min">
                                                            Mín: 200 kg
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $4.20</div>
                                                        <div class="price-sell">$6.30</div>
                                                        <div class="profit-margin">
                                                            +33.3%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/3" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/3/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=3" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/3" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            BR
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Broca HSS 12mm</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">HE002</span>
                                                                <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                            </div>
                                                            <p class="product-description">Broca helicoidal acero rápido para taladro in...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Herramientas y Equipos
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-danger">6</span>
                                                        <div class="stock-min">
                                                            Mín: 20 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $15.80</div>
                                                        <div class="price-sell">$28.50</div>
                                                        <div class="profit-margin">
                                                            +44.6%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/19" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/19/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=19" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/19" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CA
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Caja Corrugada 30x20x15cm</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">EM001</span>
                                                            </div>
                                                            <p class="product-description">Caja kraft corrugado flauta C para envíos</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Materiales de Empaque
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">2800</span>
                                                        <div class="stock-min">
                                                            Mín: 1000 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $0.45</div>
                                                        <div class="price-sell">$0.75</div>
                                                        <div class="profit-margin">
                                                            +40.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/9" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/9/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=9" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/9" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CA
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Calibrador Vernier Digital</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">HE003</span>
                                                            </div>
                                                            <p class="product-description">Calibrador digital 0-150mm precisión 0.01mm</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Herramientas y Equipos
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">12</span>
                                                        <div class="stock-min">
                                                            Mín: 5 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $45.00</div>
                                                        <div class="price-sell">$75.00</div>
                                                        <div class="profit-margin">
                                                            +40.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/20" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/20/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=20" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/20" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CA
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Capacitor Electrolítico 1000µF</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">CE002</span>
                                                            </div>
                                                            <p class="product-description">Capacitor 1000µF 25V radial para fuentes</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Componentes Electrónicos
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">1200</span>
                                                        <div class="stock-min">
                                                            Mín: 500 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $0.85</div>
                                                        <div class="price-sell">$1.35</div>
                                                        <div class="profit-margin">
                                                            +37.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/6" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/6/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=6" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/6" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CH
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Chasis Soldado Sin Pintura</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">ST002</span>
                                                                <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                            </div>
                                                            <p class="product-description">Estructura metálica soldada lista para tratam...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Productos Semi-terminados
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-danger">8</span>
                                                        <div class="stock-min">
                                                            Mín: 25 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $85.00</div>
                                                        <div class="price-sell">$125.00</div>
                                                        <div class="profit-margin">
                                                            +32.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/13" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/13/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=13" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/13" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CO
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Cobre Electrolítico</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">MP004</span>
                                                                <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                            </div>
                                                            <p class="product-description">Alambre de cobre puro 99.9% calibre 12 AWG</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Materias Primas
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-danger">45</span>
                                                        <div class="stock-min">
                                                            Mín: 300 m
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $9.80</div>
                                                        <div class="price-sell">$14.20</div>
                                                        <div class="profit-margin">
                                                            +31.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/4" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/4/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=4" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/4" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            CO
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Controlador Industrial PLC-200</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">PT001</span>
                                                            </div>
                                                            <p class="product-description">PLC para automatización industrial 16 E/S dig...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Productos Terminados
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">42</span>
                                                        <div class="stock-min">
                                                            Mín: 20 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $185.00</div>
                                                        <div class="price-sell">$295.00</div>
                                                        <div class="profit-margin">
                                                            +37.3%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/15" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/15/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=15" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/15" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            DE
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Desengrasante Industrial</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">QL002</span>
                                                                <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                            </div>
                                                            <p class="product-description">Solvente para limpieza de piezas metálicas</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Químicos y Lubricantes
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-danger">25</span>
                                                        <div class="stock-min">
                                                            Mín: 50 l
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $12.00</div>
                                                        <div class="price-sell">$22.00</div>
                                                        <div class="profit-margin">
                                                            +45.5%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/22" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/22/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=22" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/22" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            EN
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Ensamble Motor Paso a Paso</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">ST001</span>
                                                            </div>
                                                            <p class="product-description">Motor paso a paso ensamblado pendiente de cal...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Productos Semi-terminados
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">125</span>
                                                        <div class="stock-min">
                                                            Mín: 50 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $45.00</div>
                                                        <div class="price-sell">$68.00</div>
                                                        <div class="profit-margin">
                                                            +33.8%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/12" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/12/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=12" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/12" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            ET
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Etiquetas Código de Barras</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">EM002</span>
                                                            </div>
                                                            <p class="product-description">Etiquetas térmicas 4x2 pulgadas para inventar...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Materiales de Empaque
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">15000</span>
                                                        <div class="stock-min">
                                                            Mín: 5000 unidad
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $0.01</div>
                                                        <div class="price-sell">$0.02</div>
                                                        <div class="profit-margin">
                                                            +50.0%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/10" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/10/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=10" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/10" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            FL
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Flux para Soldadura</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">QL004</span>
                                                                <i class="fas fa-exclamation-triangle" style="color: var(--warning-orange); font-size: 12px;" title="Stock bajo"></i>
                                                            </div>
                                                            <p class="product-description">Pasta flux para soldadura de componentes elec...</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Químicos y Lubricantes
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-danger">4</span>
                                                        <div class="stock-min">
                                                            Mín: 15 kg
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $18.50</div>
                                                        <div class="price-sell">$32.00</div>
                                                        <div class="profit-margin">
                                                            +42.2%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/24" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/24/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=24" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/24" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <div class="product-avatar">
                                                            GR
                                                        </div>
                                                        <div class="product-details">
                                                            <h5>Grasa Litio EP2</h5>
                                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                                <span class="product-code">QL003</span>
                                                            </div>
                                                            <p class="product-description">Grasa multiuso para rodamientos y engranajes</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-category">
                                                        Químicos y Lubricantes
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="stock-info">
                                                        <span class="badge-inventory badge-stock-good">95</span>
                                                        <div class="stock-min">
                                                            Mín: 30 kg
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price-info">
                                                        <div class="price-buy">Compra: $4.80</div>
                                                        <div class="price-sell">$8.50</div>
                                                        <div class="profit-margin">
                                                            +43.5%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-inventory badge-active">Activo</span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="http://127.0.0.1:8000/productos/23" class="btn-action view" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/productos/23/edit" class="btn-action edit" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="http://127.0.0.1:8000/movimientos/create?producto_id=23" class="btn-action move" title="Movimiento">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </a>
                                                        <form action="http://127.0.0.1:8000/productos/23" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <input type="hidden" name="_token" value="tFAGOfRNM9aIEGOjyM4VtaftkdLeoRsCLxVpd5mC" autocomplete="off"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn-action delete" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Paginación -->
                                <div style="display: flex; justify-content: center; padding: 32px;">
                                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                                        <div class="flex justify-between flex-1 sm:hidden">
                                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                                                « Previous
                                            </span>

                                            <a href="http://127.0.0.1:8000/productos?page=2" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                                Next »
                                            </a>
                                        </div>

                                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                            <div>
                                                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                                                    Showing
                                                    <span class="font-medium">1</span>
                                                    to
                                                    <span class="font-medium">15</span>
                                                    of
                                                    <span class="font-medium">24</span>
                                                    results
                                                </p>
                                            </div>

                                            <div>
                                                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">

                                                    <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                    </span>





                                                    <span aria-current="page">
                                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>
                                                    </span>
                                                    <a href="http://127.0.0.1:8000/productos?page=2" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
                                                        2
                                                    </a>


                                                    <a href="http://127.0.0.1:8000/productos?page=2" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>
                        <i class="fas fa-boxes mr-2"></i>
                        Sistema de Inventario © 2025
                    </strong>
                    - Gestión Inteligente de Inventarios
                </div>
                <div class="d-none d-sm-inline-block">
                    <b>Versión</b> 1.0.0
                </div>
            </div>
        </footer>
        <div id="sidebar-overlay"></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Scripts personalizados -->
    <script>
        // Auto-hide alerts después de 5 segundos
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Efecto smooth para el sidebar collapse
            $('[data-widget="pushmenu"]').on('click', function() {
                setTimeout(function() {
                    $(window).trigger('resize');
                }, 300);
            });

            // Tooltip para iconos cuando sidebar está colapsado
            if ($('body').hasClass('sidebar-collapse')) {
                $('.nav-sidebar .nav-link').tooltip({
                    placement: 'right',
                    trigger: 'hover'
                });
            }
        });
    </script>



</body>