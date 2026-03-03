<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mensaje del Día') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card única con fondo azul y frase aleatoria -->
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
        </div>
    </div>
</x-app-layout>
