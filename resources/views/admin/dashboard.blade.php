<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Total de usuarios -->
                        <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Total de Usuarios</p>
                                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ \App\Models\User::count() }}</p>
                                </div>
                                <div class="text-4xl text-blue-200 dark:text-blue-800">👥</div>
                            </div>
                        </div>

                        <!-- Administradores -->
                        <div class="bg-purple-50 dark:bg-purple-900 p-6 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Administradores</p>
                                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                                </div>
                                <div class="text-4xl text-purple-200 dark:text-purple-800">🔑</div>
                            </div>
                        </div>

                        <!-- Mantenimiento -->
                        <div class="bg-orange-50 dark:bg-orange-900 p-6 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Mantenimiento</p>
                                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ \App\Models\User::where('role', 'maintenance')->count() }}</p>
                                </div>
                                <div class="text-4xl text-orange-200 dark:text-orange-800">🔧</div>
                            </div>
                        </div>

                        <!-- Total de boyas -->
                        <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Total de Boyas</p>
                                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ \App\Models\Boya::count() }}</p>
                                </div>
                                <div class="text-4xl text-green-200 dark:text-green-800">🌊</div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Acciones Rápidas</h4>
                        <div class="flex gap-4 flex-wrap">
                            <a href="{{ route('admin.users') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Gestionar Usuarios
                            </a>
                            <a href="{{ route('admin.boyas.index') }}" class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                Gestionar Boyas
                            </a>
                            <a href="{{ route('dashboard') }}" class="inline-block px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                Volver al Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
