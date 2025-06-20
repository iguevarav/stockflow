<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse - Sistema de Inventario</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #2c5aa0;
            --primary-blue-light: #3d6bb7;
            --secondary-dark: #1e3a5f;
            --accent-green: #27ae60;
            --warning-orange: #f39c12;
            --danger-red: #e74c3c;
            --text-primary: #2c3e50;
            --text-secondary: #5d6d7e;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --border-color: #dce6f0;
            --shadow-light: rgba(44, 90, 160, 0.08);
            --shadow-medium: rgba(44, 90, 160, 0.15);
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            padding: 2rem 0;
        }

        .auth-container {
            max-width: 450px;
            width: 100%;
            margin: 2rem;
        }

        .auth-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .auth-header {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-blue) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .auth-logo {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: white;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .auth-subtitle {
            opacity: 0.9;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }

        .auth-body {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: block;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--white);
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
            outline: none;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .form-control.with-icon {
            padding-left: 2.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-blue) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.3);
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-green) 100%);
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f0f0f0;
        }

        .auth-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .auth-link:hover {
            color: var(--secondary-dark);
            text-decoration: none;
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid var(--danger-red);
        }

        .invalid-feedback {
            color: var(--danger-red);
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: var(--danger-red);
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-weak { color: var(--danger-red); }
        .strength-medium { color: var(--warning-orange); }
        .strength-strong { color: var(--accent-green); }

        /* Row layout for form */
        .row {
            display: flex;
            gap: 1rem;
            margin: -0.75rem;
        }

        .col {
            flex: 1;
            padding: 0.75rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .auth-container {
                margin: 1rem;
            }
            
            .auth-header {
                padding: 1.5rem;
            }
            
            .auth-body {
                padding: 1.5rem;
            }
            
            .auth-logo {
                font-size: 2.5rem;
            }
            
            .auth-title {
                font-size: 1.3rem;
            }

            .row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Animaciones */
        .auth-card {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Floating particles background */
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-20px);
                opacity: 0.8;
            }
        }

        /* Scrollbar personalizado */
        .auth-body::-webkit-scrollbar {
            width: 6px;
        }

        .auth-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .auth-body::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .auth-body::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
    <!-- Background particles -->
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <!-- Header -->
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="auth-title">Sistema de Inventario</h1>
                <p class="auth-subtitle">Crear Nueva Cuenta</p>
            </div>

            <!-- Body -->
            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <div class="input-group">
                            <i class="fas fa-user input-icon"></i>
                            <input 
                                type="text" 
                                class="form-control with-icon @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                autofocus
                                placeholder="Tu nombre completo"
                            >
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input 
                                type="email" 
                                class="form-control with-icon @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
                                placeholder="usuario@ejemplo.com"
                            >
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input 
                                        type="password" 
                                        class="form-control with-icon @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        required 
                                        autocomplete="new-password"
                                        placeholder="••••••••"
                                        onkeyup="checkPasswordStrength()"
                                    >
                                </div>
                                <div id="password-strength" class="password-strength"></div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input 
                                        type="password" 
                                        class="form-control with-icon" 
                                        id="password-confirm" 
                                        name="password_confirmation" 
                                        required 
                                        autocomplete="new-password"
                                        placeholder="••••••••"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Crear Cuenta
                    </button>

                    <!-- Links -->
                    <div class="auth-links">
                        <span style="color: var(--text-secondary);">¿Ya tienes cuenta?</span>
                        <a class="auth-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthDiv = document.getElementById('password-strength');
            
            if (password.length === 0) {
                strengthDiv.innerHTML = '';
                return;
            }
            
            let strength = 0;
            let feedback = '';
            
            // Length check
            if (password.length >= 8) strength++;
            else {
                feedback = '<i class="fas fa-times"></i> La contraseña debe tener al menos 8 caracteres';
            }
            
            // Character variety checks
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Set feedback based on strength
            switch(strength) {
                case 0:
                case 1:
                    strengthDiv.innerHTML = '<span class="strength-weak">' + feedback + '</span>';
                    break;
                case 2:
                case 3:
                    strengthDiv.innerHTML = '<span class="strength-medium"><i class="fas fa-exclamation-triangle"></i> Contraseña débil</span>';
                    break;
                case 4:
                case 5:
                    strengthDiv.innerHTML = '<span class="strength-strong"><i class="fas fa-check"></i> Contraseña fuerte</span>';
                    break;
            }
        }
    </script>
</body>
</html>