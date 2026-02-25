<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Boya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Botón de regreso -->
                    <div class="mb-6">
                        <a href="{{ route('admin.boyas.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                            ← Volver a Boyas
                        </a>
                    </div>

                    <form action="{{ route('admin.boyas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Usuario -->
                        <div>
                            <label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Usuario (Opcional)
                            </label>
                            <select id="id_user" name="id_user" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">
                                <option value="">Sin asignar (para reclamar después)</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Deja vacío si deseas que un usuario reclame la boya con el código
                            </p>
                        </div>

                        <!-- Código de Canjeo -->
                        <div>
                            <label for="codigo_de_canjeo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Código de Canjeo
                            </label>
                            <input type="text" id="codigo_de_canjeo" name="codigo_de_canjeo" value="{{ old('codigo_de_canjeo') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                            @error('codigo_de_canjeo')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nombre
                            </label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modelo -->
                        <div>
                            <label for="modelo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Modelo
                            </label>
                            <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                            @error('modelo')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Latitud y Longitud -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="latitud" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Latitud
                                </label>
                                <input type="number" step="0.000001" id="latitud" name="latitud" value="{{ old('latitud') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                                @error('latitud')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="longitud" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Longitud
                                </label>
                                <input type="number" step="0.000001" id="longitud" name="longitud" value="{{ old('longitud') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                                @error('longitud')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Fechas -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="fecha_fabricacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha de Fabricación
                                </label>
                                <input type="date" id="fecha_fabricacion" name="fecha_fabricacion" value="{{ old('fecha_fabricacion') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" required>
                                @error('fecha_fabricacion')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="fecha_mantenimiento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha de Mantenimiento
                                </label>
                                <input type="date" id="fecha_mantenimiento" name="fecha_mantenimiento" value="{{ old('fecha_mantenimiento') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">
                                @error('fecha_mantenimiento')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Crear Boya
                            </button>
                            <a href="{{ route('admin.boyas.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
