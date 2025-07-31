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


    <!-- Enlace al archivo CSS personalizado del sistema -->
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">

    @stack('styles')
</head>

<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="fas fa-dolly-flatbed brand-icon"></i>

                <span class="brand-text"> SUPCHAIN</span>
            </a>

            <!-- Sidebar Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('/') || request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <span class="nav-text">Clientes</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('proveedores.index') }}" class="nav-link {{ request()->is('proveedores*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <span class="nav-text">Proveedores</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('productos.index') }}" class="nav-link {{ request()->is('productos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <span class="nav-text">Productos</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('orden_compra.index') }}" class="nav-link {{ request()->is('ordenes_compra*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <span class="nav-text">Compras</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('ventas.index') }}" class="nav-link {{ request()->is('ventas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <span class="nav-text">Ventas</span>
                    </a>
                </div>
               


                <div class="nav-item">
                    <a href="{{ route('movimientos.index') }}" class="nav-link {{ request()->is('movimientos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <span class="nav-text">Movimientos</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('categorias.index') }}" class="nav-link {{ request()->is('categorias*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <span class="nav-text">Categorías</span>
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
                    <div class="dropdown">
                        <a href="#" class="user-menu dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 0.5rem;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item logout-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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