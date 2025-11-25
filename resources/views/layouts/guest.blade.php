<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AquaSentinel') }} - @yield('title', 'Acceso')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Styles -->
        <style>
            :root {
                --blue: #0A75D1;
                --blue-dark: #084B8A;
                --blue-lite: #EAF6FF;
                --white: #ffffff;
                --gray: #6b7280;
                --transition: all 0.3s ease;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #EAF6FF 0%, #ffffff 100%);
                color: #1f2937;
                min-height: 100vh;
                margin: 0;
                padding: 0;
            }

            .guest-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem 1rem;
            }

            .logo-section {
                text-align: center;
                margin-bottom: 2rem;
            }

            .logo-link {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                color: var(--blue-dark);
                font-weight: 700;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .logo-link img {
                height: 50px;
                margin-right: 12px;
            }

            .guest-card {
                width: 100%;
                max-width: 440px;
                background: white;
                border-radius: 16px;
                padding: 2.5rem;
                box-shadow: 0 15px 50px rgba(0, 51, 120, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .guest-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .guest-header h1 {
                font-size: 1.75rem;
                font-weight: 700;
                color: var(--blue-dark);
                margin-bottom: 0.5rem;
            }

            .guest-header p {
                color: var(--gray);
                font-size: 1rem;
            }

            /* Form Styles */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: var(--blue-dark);
                font-size: 0.9rem;
            }

            .form-input {
                width: 100%;
                padding: 0.875rem 1rem;
                border: 1.5px solid #e2e8f0;
                border-radius: 10px;
                font-size: 1rem;
                transition: var(--transition);
                background: white;
            }

            .form-input:focus {
                outline: none;
                border-color: var(--blue);
                box-shadow: 0 0 0 3px rgba(10, 117, 209, 0.1);
            }

            .btn-primary {
                width: 100%;
                padding: 0.875rem;
                background: var(--blue);
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                margin-top: 0.5rem;
            }

            .btn-primary:hover {
                background: var(--blue-dark);
                transform: translateY(-1px);
                box-shadow: 0 6px 15px rgba(10, 117, 209, 0.3);
            }

            .form-links {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 1.5rem 0;
                font-size: 0.9rem;
            }

            .remember-me {
                display: flex;
                align-items: center;
            }

            .remember-me input {
                margin-right: 0.5rem;
                accent-color: var(--blue);
            }

            .forgot-password {
                color: var(--blue);
                text-decoration: none;
                font-weight: 500;
            }

            .forgot-password:hover {
                color: var(--blue-dark);
                text-decoration: underline;
            }

            .auth-links {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid #e2e8f0;
                color: var(--gray);
            }

            .auth-links a {
                color: var(--blue);
                text-decoration: none;
                font-weight: 600;
            }

            .auth-links a:hover {
                color: var(--blue-dark);
                text-decoration: underline;
            }

            /* Alerts */
            .alert {
                padding: 0.875rem 1rem;
                border-radius: 10px;
                margin-bottom: 1.5rem;
                font-size: 0.9rem;
            }

            .alert-success {
                background: #f0fff4;
                color: #22543d;
                border: 1px solid #9ae6b4;
            }

            .alert-error {
                background: #fed7d7;
                color: #742a2a;
                border: 1px solid #feb2b2;
            }

            .input-error {
                color: #e53e3e;
                font-size: 0.8rem;
                margin-top: 0.25rem;
            }

            @media (max-width: 480px) {
                .guest-card {
                    padding: 2rem 1.5rem;
                }

                .form-links {
                    flex-direction: column;
                    gap: 1rem;
                    align-items: flex-start;
                }
            }
        </style>

        <!-- Scripts - VITE CORREGIDO -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="guest-container">
            <div class="logo-section">
                <a href="{{ url('/') }}" class="logo-link">
                    <img src="{{ asset('images/icon-aquacentinel.png') }}" alt="AquaSentinel">
                    AquaSentinel
                </a>
            </div>

            <div class="guest-card">
                <div class="guest-header">
                    <h1>@yield('page-title', 'Bienvenido')</h1>
                    <p>@yield('page-description', 'Accede a tu cuenta')</p>
                </div>

                {{ $slot }}
            </div>
        </div>

        <!-- Scripts adicionales si es necesario -->
        @stack('scripts')
    </body>
</html>
