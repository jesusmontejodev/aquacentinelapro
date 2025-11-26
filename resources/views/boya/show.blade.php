<x-app-layout>
    <!-- Header con navegación -->
    <div class="mb-8">
        <a href="{{ route('boya.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 mb-6 group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Volver a mis boyas
        </a>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-blue-900 mb-2">Dashboard de la Boya</h1>
                <p class="text-gray-600 text-lg">Monitoreo en tiempo real de la calidad del agua</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-4">
                <span id="realtime-badge" class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full flex items-center">
                    <i class="fas fa-circle text-green-500 mr-2 animate-pulse"></i>
                    Actualizando en tiempo real
                </span>
                <div class="text-sm text-gray-500 flex items-center">
                    <i class="fas fa-sync-alt mr-2"></i>
                    <span id="last-update">Actualizado ahora</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel de Diagnóstico General -->
    <div id="diagnostico-general" class="mb-10 p-6 bg-white rounded-xl shadow-lg border-l-8 transition-all duration-300 border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Diagnóstico del Agua</h2>
        <p id="diagnostico-texto" class="text-lg text-gray-700">
            Cargando diagnóstico...
        </p>
        <div id="diagnostico-descripcion" class="mt-4 text-sm text-gray-600 leading-relaxed">
            Analizando condiciones actuales...
        </div>
    </div>

    <!-- Tarjetas de Métricas en Tiempo Real -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <!-- Conductividad -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-bolt text-blue-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">µS/cm</span>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Conductividad</h3>
            <div class="flex items-end justify-between">
                <div class="flex items-baseline">
                    <span id="conductividad-data" class="text-2xl font-bold text-gray-800 animate-pulse">--</span>
                    <span class="text-gray-500 text-sm ml-1">µS/cm</span>
                </div>
                <div id="conductividad-status" class="text-sm font-semibold flex items-center">
                    <!-- JS inyecta estado -->
                </div>
            </div>
        </div>

        <!-- pH -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-green-600"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tint text-green-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">pH</span>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Nivel de pH</h3>
            <div class="flex items-end justify-between">
                <div class="flex items-baseline">
                    <span id="pH-data" class="text-2xl font-bold text-gray-800 animate-pulse">--</span>
                    <span class="text-gray-500 text-sm ml-1">pH</span>
                </div>
                <div id="ph-status" class="text-sm font-semibold flex items-center">
                    <!-- JS inyecta estado -->
                </div>
            </div>
        </div>

        <!-- Temperatura -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-orange-600"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-thermometer-half text-orange-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded">°C</span>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Temperatura</h3>
            <div class="flex items-end justify-between">
                <div class="flex items-baseline">
                    <span id="temperatura-data" class="text-2xl font-bold text-gray-800 animate-pulse">--</span>
                    <span class="text-gray-500 text-sm ml-1">°C</span>
                </div>
                <div id="temperatura-status" class="text-sm font-semibold flex items-center">
                    <!-- JS inyecta estado -->
                </div>
            </div>
        </div>

        <!-- Turbidez -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-purple-600"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-1 rounded">NTU</span>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Turbidez</h3>
            <div class="flex items-end justify-between">
                <div class="flex items-baseline">
                    <span id="turbidez-data" class="text-2xl font-bold text-gray-800 animate-pulse">--</span>
                    <span class="text-gray-500 text-sm ml-1">NTU</span>
                </div>
                <div id="turbidez-status" class="text-sm font-semibold flex items-center">
                    <!-- JS inyecta estado -->
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Gráficas -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-blue-900 mb-2">Historial de Métricas</h2>
        <p class="text-gray-600">Datos recopilados en tiempo real - Actualización automática cada 10 segundos</p>
    </div>

    <div class="padre-graficas grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="grafica-card bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="titulo-grafica text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-bolt text-blue-600 mr-3"></i>
                    Conductividad
                </h3>
                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">µS/cm</span>
            </div>
            <canvas id="grafica-conductividad" data-id="{{ $boya->id }}" class="contenedor-grafica h-80"></canvas>
        </div>

        <div class="grafica-card bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="titulo-grafica text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-tint text-green-600 mr-3"></i>
                    Nivel de pH
                </h3>
                <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">pH</span>
            </div>
            <canvas id="graficaPH" data-id="{{ $boya->id }}" class="contenedor-grafica h-80"></canvas>
        </div>

        <div class="grafica-card bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="titulo-grafica text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-thermometer-half text-orange-600 mr-3"></i>
                    Temperatura
                </h3>
                <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full">°C</span>
            </div>
            <canvas id="grafica-temperatura" data-id="{{ $boya->id }}" class="contenedor-grafica h-80"></canvas>
        </div>

        <div class="grafica-card bg-white rounded-xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="titulo-grafica text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-eye text-purple-600 mr-3"></i>
                    Turbidez
                </h3>
                <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full">NTU</span>
            </div>
            <canvas id="grafica-turbidez" data-id="{{ $boya->id }}" class="contenedor-grafica h-80"></canvas>
        </div>
    </div>

    @push('scripts')
        @vite([
            'resources/js/boya/graficaConductividad.js',
            'resources/js/boya/graficaPh.js',
            'resources/js/boya/graficaTemperatura.js',
            'resources/js/boya/graficaTurbidez.js',
            'resources/js/boya/calidadAgua.js'
        ])

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const idBoya = document.getElementById('grafica-conductividad').dataset.id;
                const apiBase = '{{ url("/api") }}';
                const lastUpdateElement = document.getElementById('last-update');

                const f = v => (v != null && !isNaN(v)) ? Number(v).toFixed(2) : "--";

                function updateTimestamp() {
                    lastUpdateElement.textContent = "Actualizado: " + new Date().toLocaleTimeString();
                }

                /*** RANGOS SIN SOLAPAMIENTO ***/
                const RANGOS = {
                    ph: [
                        { min: 6.5, max: 8.5, texto: "Óptimo", color: "text-green-500", icon: "fa-check" },
                        { min: 6.0, max: 6.49, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: 8.51, max: 9.0, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: -9999, max: 99999, texto: "Crítico", color: "text-red-500", icon: "fa-times" }
                    ],
                    conductividad: [
                        { min: 200, max: 800, texto: "Óptima", color: "text-green-500", icon: "fa-check" },
                        { min: 150, max: 199, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: 801, max: 1000, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: -9999, max: 99999, texto: "Crítica", color: "text-red-500", icon: "fa-times" }
                    ],
                    temperatura: [
                        { min: 20, max: 28, texto: "Óptima", color: "text-green-500", icon: "fa-check" },
                        { min: 18, max: 19.9, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: 28.1, max: 30, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: -9999, max: 99999, texto: "Crítica", color: "text-red-500", icon: "fa-times" }
                    ],
                    turbidez: [
                        { min: -9999, max: 5, texto: "Clara", color: "text-green-500", icon: "fa-check" },
                        { min: 5.01, max: 10, texto: "Mantenimiento", color: "text-yellow-500", icon: "fa-exclamation" },
                        { min: 10.01, max: 99999, texto: "Bacteriológico", color: "text-red-500", icon: "fa-viruses" }
                    ]
                };

                /*** FUNCIÓN ÚNICA PARA ACTUALIZAR TARJETAS ***/
                function actualizarCampo(id, valor, rangos) {
                    const el = document.getElementById(id);
                    const v = Number(valor);

                    if (!el || isNaN(v)) {
                        el.innerHTML = `<i class="fas fa-question-circle text-gray-400 mr-1"></i>Sin datos`;
                        return;
                    }

                    const r = rangos.find(r => v >= r.min && v <= r.max);

                    el.innerHTML = `<i class="fas ${r.icon} mr-1 ${r.color}"></i>
                                    <span class="${r.color}">${r.texto}</span>`;
                }

                /*** LÓGICA DIFUSA SIMPLE / "MARCHING LEARNING" ***/
                function diagnosticoGlobal(vals) {
                    const panel = document.getElementById("diagnostico-general");
                    const texto = document.getElementById("diagnostico-texto");
                    const desc = document.getElementById("diagnostico-descripcion");

                    const estados = [];

                    function pushEstado(param, v) {
                        const r = RANGOS[param].find(r => v >= r.min && v <= r.max);
                        estados.push(r.texto);
                    }

                    pushEstado("ph", vals.ph);
                    pushEstado("temperatura", vals.temperatura);
                    pushEstado("conductividad", vals.conductividad);
                    pushEstado("turbidez", vals.turbidez);

                    const buenos = estados.filter(e => e === "Óptimo" || e === "Óptima" || e === "Clara").length;
                    const malos = estados.filter(e => e === "Crítico" || e === "Bacteriológico").length;
                    const mantenimiento = estados.filter(e => e === "Mantenimiento").length;

                    // Lógica tipo difusa
                    if (malos >= 2) {
                        texto.textContent = "Rojo → Riesgo bacteriológico";
                        desc.textContent = "Varias variables están en estado grave. Recomendado estudio bacteriológico.";
                        panel.className = "mb-10 p-6 bg-white rounded-xl shadow-lg border-l-8 border-red-500";
                    }
                    else if (malos === 1 || mantenimiento >= 2) {
                        texto.textContent = "Naranja → Requiere tratamiento";
                        desc.textContent = "Al menos un parámetro crítico o varios en mantenimiento.";
                        panel.className = "mb-10 p-6 bg-white rounded-xl shadow-lg border-l-8 border-yellow-500";
                    }
                    else if (mantenimiento === 1) {
                        texto.textContent = "Amarillo → Mantenimiento recomendado";
                        desc.textContent = "Un parámetro está ligeramente fuera de rango.";
                        panel.className = "mb-10 p-6 bg-white rounded-xl shadow-lg border-l-8 border-yellow-500";
                    }
                    else {
                        texto.textContent = "Verde → Agua en estado óptimo";
                        desc.textContent = "Todos los parámetros dentro de rango normal.";
                        panel.className = "mb-10 p-6 bg-white rounded-xl shadow-lg border-l-8 border-green-500";
                    }
                }

                /*** CONSULTA AL API ***/
                async function obtenerUltimoRegistro() {
                    try {
                        const res = await fetch(`${apiBase}/boya/${idBoya}/ultimo-registro`);
                        if (!res.ok) throw new Error();

                        const d = await res.json();

                        // Mostrar datos
                        document.getElementById("conductividad-data").textContent = f(d.conductividad);
                        document.getElementById("pH-data").textContent = f(d.ph);
                        document.getElementById("temperatura-data").textContent = f(d.temperatura);
                        document.getElementById("turbidez-data").textContent = f(d.turbidez);

                        // Actualizar estados
                        actualizarCampo("ph-status", d.ph, RANGOS.ph);
                        actualizarCampo("conductividad-status", d.conductividad, RANGOS.conductividad);
                        actualizarCampo("temperatura-status", d.temperatura, RANGOS.temperatura);
                        actualizarCampo("turbidez-status", d.turbidez, RANGOS.turbidez);

                        diagnosticoGlobal({
                            ph: d.ph,
                            conductividad: d.conductividad,
                            temperatura: d.temperatura,
                            turbidez: d.turbidez
                        });

                    } catch (err) {
                        console.error(err);
                    }
                }

                async function actualizarTodo() {
                    await obtenerUltimoRegistro();
                    updateTimestamp();
                }

                actualizarTodo();
                setInterval(actualizarTodo, 10000);
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const API_BASE = "/api/boya";

            let charts = {
                ph: null,
                conductividad: null,
                temperatura: null,
                turbidez: null
            };

            // ======================
            // Cargar histórico desde API
            // ======================
            async function obtenerHistorico(id) {
                const res = await fetch(`${API_BASE}/${id}/historico`);
                return res.json();
            }

            // ======================
            // Crear o actualizar gráficas (ESTÉTICAS)
            // ======================
            function actualizarGrafica(chart, idCanvas, labels, valores, lineasGuia) {
                const ctx = document.getElementById(idCanvas);

                if (!chart) {
                    return new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Valor",
                                    data: valores,
                                    borderWidth: 3,
                                    tension: 0.4,
                                    pointRadius: 0,
                                    borderColor: "rgba(33,150,243,0.9)"
                                },

                                ...lineasGuia.map(l => ({
                                    label: l.label,
                                    data: Array(labels.length).fill(l.valor),
                                    borderWidth: 1.5,
                                    borderDash: [6, 4],
                                    pointRadius: 0,
                                    borderColor: l.color
                                }))
                            ],
                        },
                        options: {
                            animation: false,
                            responsive: true,
                            interaction: {
                                intersect: false,
                                mode: "index"
                            },
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    grid: { color: "rgba(0,0,0,0.05)" }
                                },
                                x: {
                                    grid: { display: false }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: "bottom",
                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: "line"
                                    }
                                }
                            }
                        }
                    });

                } else {
                    // Actualizamos únicamente
                    chart.data.labels = labels;
                    chart.data.datasets[0].data = valores;

                    lineasGuia.forEach((l, i) => {
                        chart.data.datasets[i + 1].data = Array(labels.length).fill(l.valor);
                    });

                    chart.update();
                    return chart;
                }
            }

            // ======================
            // Líneas Guía (YA CON BUENO / REGULAR / MALO)
            // ======================
            const GUÍAS = {
                ph: [
                    { label: "Bueno (6.5–8.5)", valor: 8.5, color: "rgba(0,200,83,0.6)" },
                    { label: "Regular (9.0)", valor: 9.0, color: "rgba(255,193,7,0.6)" },
                    { label: "Malo (10+)", valor: 10, color: "rgba(244,67,54,0.6)" }
                ],
                conductividad: [
                    { label: "Bueno (800)", valor: 800, color: "rgba(0,200,83,0.6)" },
                    { label: "Regular (1000)", valor: 1000, color: "rgba(255,193,7,0.6)" },
                    { label: "Malo (1200)", valor: 1200, color: "rgba(244,67,54,0.6)" }
                ],
                temperatura: [
                    { label: "Bueno (28°C)", valor: 28, color: "rgba(0,200,83,0.6)" },
                    { label: "Regular (30°C)", valor: 30, color: "rgba(255,193,7,0.6)" },
                    { label: "Malo (32°C)", valor: 32, color: "rgba(244,67,54,0.6)" }
                ],
                turbidez: [
                    { label: "Bueno (5 NTU)", valor: 5, color: "rgba(0,200,83,0.6)" },
                    { label: "Regular (10 NTU)", valor: 10, color: "rgba(255,193,7,0.6)" },
                    { label: "Malo (15 NTU)", valor: 15, color: "rgba(244,67,54,0.6)" }
                ]
            };

            // ======================
            // Función general para actualizar todas las gráficas
            // ======================
            async function actualizarGraficas() {
                const idBoya = document.querySelector("[data-id]").dataset.id;

                const data = await obtenerHistorico(idBoya);

                const labelsPH = data.ph.map(r => new Date(r.created_at).toLocaleTimeString());
                const labelsC = data.conductividad.map(r => new Date(r.created_at).toLocaleTimeString());
                const labelsT = data.temperatura.map(r => new Date(r.created_at).toLocaleTimeString());
                const labelsTb = data.turbidez.map(r => new Date(r.created_at).toLocaleTimeString());

                charts.ph = actualizarGrafica(
                    charts.ph,
                    "graficaPH",
                    labelsPH,
                    data.ph.map(r => r.valor),
                    GUÍAS.ph
                );

                charts.conductividad = actualizarGrafica(
                    charts.conductividad,
                    "grafica-conductividad",
                    labelsC,
                    data.conductividad.map(r => r.valor),
                    GUÍAS.conductividad
                );

                charts.temperatura = actualizarGrafica(
                    charts.temperatura,
                    "grafica-temperatura",
                    labelsT,
                    data.temperatura.map(r => r.valor),
                    GUÍAS.temperatura
                );

                charts.turbidez = actualizarGrafica(
                    charts.turbidez,
                    "grafica-turbidez",
                    labelsTb,
                    data.turbidez.map(r => r.valor),
                    GUÍAS.turbidez
                );
            }

            // Ejecutar al inicio
            actualizarGraficas();

            // Actualizar cada 5 segundos
            setInterval(actualizarGraficas, 5000);
        </script>


        <style>
            .animate-pulse { animation: pulse 1s ease-in-out; }
            @keyframes pulse { 0% { opacity: 1; } 50% { opacity: .7; } 100% { opacity: 1; } }

            .contenedor-grafica { position: relative; }
            .contenedor-grafica::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, transparent, rgba(10, 117, 209, 0.02));
                border-radius: 8px;
            }

            .contenedor-grafica {
                width: 100% !important;
                height: 320px !important;
            }

            .status-warning { color: #f59e0b; }
            .status-danger { color: #ef4444; }
            .status-optimal { color: #10b981; }
        </style>

    @endpush
</x-app-layout>
