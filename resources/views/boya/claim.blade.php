<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reclamar Boya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Reclamar una Boya</h3>

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Ingresa el código de canjeo que recibiste para reclamar la boya.
                    </p>

                    <form action="{{ route('boya.claim.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="codigo_de_canjeo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Código de Canjeo
                            </label>
                            <input 
                                type="text" 
                                id="codigo_de_canjeo" 
                                name="codigo_de_canjeo" 
                                value="{{ old('codigo_de_canjeo') }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" 
                                placeholder="Ingresa el código aquí"
                                required
                                autofocus
                            >
                            @error('codigo_de_canjeo')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Reclamar Boya
                        </button>

                        <a href="{{ route('boya.index') }}" class="block text-center text-blue-600 dark:text-blue-400 hover:underline text-sm">
                            ← Volver a Mis Boyas
                        </a>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-sm mb-2">¿No tienes código?</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Contacta con un administrador para obtener un código de canjeo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
