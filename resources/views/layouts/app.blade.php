<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AquaCentinel - @yield('title', 'Dashboard')</title>
    <meta name="description" content="Sistema IoT para monitoreo inteligente de calidad del agua en tiempo real. Mide pH, turbidez, TDS y temperatura mediante boya conectada a la nube.">
    <link rel="icon" type="image/png" href="{{ asset('images/icon-aquacentinel.png') }}">
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
            --gray-light: #f8fafc;
            --gray-border: #e2e8f0;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-light);
            color: #1f2937;
            line-height: 1.6;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid var(--gray-border);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            z-index: 40;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Header */
        .page-header {
            background: white;
            border-bottom: 1px solid var(--gray-border);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            z-index: 30;
        }

        /* Main Content */
        .page-content {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background: var(--gray-light);
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Buttons */
        .btn-primary {
            background: var(--blue);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(10, 117, 209, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                height: 100vh;
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .page-content {
                padding: 1rem;
            }
        }
    </style>

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/main.css',
        'resources/js/app.js'
    ])
</head>

<body class="antialiased">
    <div class="app-container">

        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            @include('layouts.navigation')
        </aside>

        <!-- Main Content -->
        <div class="content-area">

            <!-- Mobile Header -->
            <div class="page-header flex items-center justify-between p-4 md:hidden">
                <button id="mobile-menu-toggle" class="p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
                <div class="flex items-center">
                    <img src="{{ asset('images/icon-aquacentinel.png') }}" class="h-8" alt="AquaSentinel">
                    <span class="ml-2 font-semibold text-blue-900">AquaSentinel</span>
                </div>
            </div>

            <!-- Page Header -->
            @isset($header)
                <header class="page-header hidden md:block px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-blue-900">{{ $header }}</h1>
                        <div class="flex items-center space-x-4">
                            <!-- User menu or other header elements -->
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="page-content">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('mobile-open');
        });
    </script>

    @stack('scripts')
</body>
</html>