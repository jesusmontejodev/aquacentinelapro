<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bienvenida Aleatoria -->
            <div class="bg-blue-600 dark:bg-blue-700 text-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Hola, {{ Auth::user()->name }}!</h3>
                    <p id="water-phrase" class="text-white">Cargando mensaje...</p>
                    <button id="refresh-phrase" class="mt-4 inline-block px-3 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">
                        Otro mensaje
                    </button>
                </div>
            </div>

            <script>
                (function() {
                    const phrases = [
                        "Cada gota cuenta: cuida el agua hoy para mañana.",
                        "Protege el agua, protege la vida: actúa con responsabilidad.",
                        "Ahorra agua: pequeñas acciones, grandes cambios.",
                        "El agua es un tesoro: no la desperdicies.",
                        "Cuida el agua y estarás cuidando nuestro futuro.",
                        "Usa el agua con respeto, es un recurso limitado."
                    ];
                    function setPhrase() {
                        const el = document.getElementById('water-phrase');
                        if (!el) return;
                        const p = phrases[Math.floor(Math.random() * phrases.length)];
                        el.textContent = p;
                    }
                    document.addEventListener('DOMContentLoaded', setPhrase);
                    document.addEventListener('click', function(e){
                        if(e.target && e.target.id === 'refresh-phrase') setPhrase();
                    });
                })();
            </script>
            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-2">Bienvenido, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 dark:text-gray-400">Tu rol: <span class="font-semibold">{{ Auth::user()->role->label() }}</span></p>
                </div>
            </div>

            <!-- Rutas de Usuario Normal -->
            @if(!Auth::user()->isAdmin())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mi Perfil -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Mi Perfil</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Gestiona tu información personal y configuración de cuenta</p>
                            <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Ir a Mi Perfil
                            </a>
                        </div>
                    </div>

                    <!-- Mis Boyas -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-water text-green-600 dark:text-green-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Mis Boyas</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Visualiza y gestiona todas tus boyas inteligentes</p>
                            <a href="{{ route('boya.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                Ver Mis Boyas
                            </a>
                        </div>
                    </div>

                    <!-- Reclamar Boya -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-gift text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Reclamar Boya</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Usa un código de canjeo para reclamar una nueva boya</p>
                            <a href="{{ route('boya.claim') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                Reclamar Boya
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Rutas de Administrador -->
            @if(Auth::user()->isAdmin())
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Panel de Administración</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Panel Admin -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-tachometer-alt text-red-600 dark:text-red-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Panel de Admin</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Accede al panel de administración general con estadísticas</p>
                            <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Ir al Panel
                            </a>
                        </div>
                    </div>

                    <!-- Gestionar Usuarios -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-users text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Gestionar Usuarios</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Ver, editar y administrar todos los usuarios del sistema</p>
                            <a href="{{ route('admin.users') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Ver Usuarios
                            </a>
                        </div>
                    </div>

                    <!-- Gestionar Boyas -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-water text-green-600 dark:text-green-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Gestionar Boyas</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Crear, editar y eliminar boyas del sistema</p>
                            <a href="{{ route('admin.boyas.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                Ver Boyas
                            </a>
                        </div>
                    </div>

                    <!-- Mi Perfil -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <h4 class="text-lg font-semibold">Mi Perfil</h4>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Actualiza tu información personal y configuración</p>
                            <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                Ir a Mi Perfil
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
