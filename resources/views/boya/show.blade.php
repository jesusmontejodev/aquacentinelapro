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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // ======================
            // CONFIGURACIÓN GLOBAL
            // ======================
            const API_BASE = '/api/boya';
            let charts = {};

            // Rangos para zonas de color
            const ZONAS = {
                ph: [
                    { min: 0, max: 6.5, color: "rgba(244,67,54,0.3)", label: "Peligro ácido" },
                    { min: 6.5, max: 8.5, color: "rgba(76,175,80,0.3)", label: "Óptimo" },
                    { min: 8.5, max: 9.0, color: "rgba(255,235,59,0.3)", label: "Alerta" },
                    { min: 9.0, max: 14, color: "rgba(244,67,54,0.3)", label: "Peligro básico" }
                ],
                temperatura: [
                    { min: 0, max: 18, color: "rgba(33,150,243,0.3)", label: "Frío" },
                    { min: 18, max: 24, color: "rgba(76,175,80,0.3)", label: "Óptimo" },
                    { min: 24, max: 28, color: "rgba(255,235,59,0.3)", label: "Cálido" },
                    { min: 28, max: 40, color: "rgba(244,67,54,0.3)", label: "Calor extremo" }
                ]
            };

            // Líneas guía para conductividad y turbidez
            const LINEAS_GUIA = {
                conductividad: [
                    { valor: 800, color: "rgba(76,175,80,0.8)", label: "Bueno (≤800 µS/cm)", borderDash: [] },
                    { valor: 1000, color: "rgba(255,193,7,0.8)", label: "Regular (≤1000 µS/cm)", borderDash: [5, 5] },
                    { valor: 1200, color: "rgba(244,67,54,0.8)", label: "Malo (>1200 µS/cm)", borderDash: [2, 2] }
                ],
                turbidez: [
                    { valor: 5, color: "rgba(76,175,80,0.8)", label: "Clara (≤5 NTU)", borderDash: [] },
                    { valor: 10, color: "rgba(255,193,7,0.8)", label: "Mantenimiento (≤10 NTU)", borderDash: [5, 5] },
                    { valor: 15, color: "rgba(244,67,54,0.8)", label: "Bacteriológico (>15 NTU)", borderDash: [2, 2] }
                ]
            };

            // Colores para las líneas
            const COLORES = {
                ph: "rgba(33,150,243,1)",
                conductividad: "rgba(33,150,243,1)",
                temperatura: "rgba(255,87,34,1)",
                turbidez: "rgba(156,39,176,1)"
            };

            // ======================
            // FUNCIONES PARA GRÁFICAS
            // ======================

            // Plugin para zonas de color
            const zonasPlugin = {
                id: 'zonasPlugin',
                beforeDraw(chart, args, options) {
                    const { ctx, chartArea: { top, bottom, left, right }, scales: { y } } = chart;

                    // Verificar que tenemos escalas
                    if (!y) return;

                    const zonas = chart.config._config.zonas || [];

                    zonas.forEach(zona => {
                        const yMin = y.getPixelForValue(zona.max);
                        const yMax = y.getPixelForValue(zona.min);

                        ctx.save();
                        ctx.fillStyle = zona.color;
                        ctx.fillRect(left, yMin, right - left, yMax - yMin);
                        ctx.restore();
                    });
                }
            };

            // Registrar el plugin globalmente
            Chart.register(zonasPlugin);

            function crearGraficaConZonas(idCanvas, labels, valores, zonas, colorLinea, unidad) {
                const ctx = document.getElementById(idCanvas);
                if (!ctx) {
                    console.error(⁠ Canvas con id ${idCanvas} no encontrado ⁠);
                    return null;
                }

                // Destruir gráfica existente
                if (charts[idCanvas]) {
                    charts[idCanvas].destroy();
                }

                try {
                    charts[idCanvas] = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: getLabelFromId(idCanvas),
                                data: valores,
                                borderColor: colorLinea,
                                backgroundColor: colorLinea.replace('1)', '0.1)'),
                                borderWidth: 3,
                                pointRadius: 4,
                                pointBackgroundColor: colorLinea,
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                tension: 0.4,
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 0
                            },
                            interaction: {
                                intersect: false,
                                mode: "index"
                            },
                            scales: {
                                y: {
                                    beginAtZero: idCanvas !== 'graficaPH',
                                    grid: {
                                        color: "rgba(0,0,0,0.1)",
                                        drawBorder: false
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return value + (unidad ? ' ' + unidad : '');
                                        },
                                        color: "rgba(0,0,0,0.7)"
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        maxTicksLimit: 6,
                                        color: "rgba(0,0,0,0.7)"
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        color: "rgba(0,0,0,0.8)"
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(255,255,255,0.9)',
                                    titleColor: '#000',
                                    bodyColor: '#000',
                                    borderColor: 'rgba(0,0,0,0.1)',
                                    borderWidth: 1
                                }
                            }
                        },
                        // Pasar zonas como configuración personalizada
                        zonas: zonas
                    });

                    return charts[idCanvas];
                } catch (error) {
                    console.error(⁠ Error creando gráfica ${idCanvas}: ⁠, error);
                    return null;
                }
            }

            function crearGraficaConLineasGuia(idCanvas, labels, valores, lineasGuia, colorLinea, unidad) {
                const ctx = document.getElementById(idCanvas);
                if (!ctx) {
                    console.error(⁠ Canvas con id ${idCanvas} no encontrado ⁠);
                    return null;
                }

                // Destruir gráfica existente
                if (charts[idCanvas]) {
                    charts[idCanvas].destroy();
                }

                try {
                    // Crear datasets para las líneas guía
                    const datasetsGuia = lineasGuia.map(linea => ({
                        label: linea.label,
                        data: Array(labels.length).fill(linea.valor),
                        borderColor: linea.color,
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: linea.borderDash,
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        fill: false,
                        tension: 0
                    }));

                    // Dataset principal
                    const datasetPrincipal = {
                        label: getLabelFromId(idCanvas),
                        data: valores,
                        borderColor: colorLinea,
                        backgroundColor: colorLinea.replace('1)', '0.1)'),
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: colorLinea,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        tension: 0.4,
                        fill: false
                    };

                    // Combinar todos los datasets (líneas guía primero, datos principales después)
                    const allDatasets = [...datasetsGuia, datasetPrincipal];

                    charts[idCanvas] = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: allDatasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 0
                            },
                            interaction: {
                                intersect: false,
                                mode: "index"
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: "rgba(0,0,0,0.1)",
                                        drawBorder: false
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return value + (unidad ? ' ' + unidad : '');
                                        },
                                        color: "rgba(0,0,0,0.7)"
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        maxTicksLimit: 6,
                                        color: "rgba(0,0,0,0.7)"
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        color: "rgba(0,0,0,0.8)",
                                        filter: function(legendItem, chartData) {
                                            // Mostrar solo la leyenda del dataset principal y las líneas guía importantes
                                            return true;
                                        }
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(255,255,255,0.9)',
                                    titleColor: '#000',
                                    bodyColor: '#000',
                                    borderColor: 'rgba(0,0,0,0.1)',
                                    borderWidth: 1,
                                    filter: function(tooltipItem) {
                                        // Mostrar tooltip solo para el dataset principal (datos reales)
                                        return tooltipItem.datasetIndex === allDatasets.length - 1;
                                    }
                                }
                            }
                        }
                    });

                    return charts[idCanvas];
                } catch (error) {
                    console.error(⁠ Error creando gráfica ${idCanvas}: ⁠, error);
                    return null;
                }
            }

            function getLabelFromId(idCanvas) {
                const labels = {
                    'graficaPH': 'Nivel de pH',
                    'grafica-conductividad': 'Conductividad',
                    'grafica-temperatura': 'Temperatura',
                    'grafica-turbidez': 'Turbidez'
                };
                return labels[idCanvas] || 'Datos';
            }

            // ======================
            // FUNCIONES DE DATOS
            // ======================

            async function obtenerDatosHistoricos(idBoya) {
                try {
                    console.log('Obteniendo datos históricos para boya:', idBoya);
                    const res = await fetch(⁠ ${API_BASE}/${idBoya}/historico ⁠);
                    if (!res.ok) throw new Error(⁠ HTTP error! status: ${res.status} ⁠);
                    const data = await res.json();
                    console.log('Datos históricos recibidos:', data);
                    return data;
                } catch (error) {
                    console.error('Error cargando datos históricos:', error);
                    // Datos de ejemplo como fallback
                    return generarDatosEjemplo();
                }
            }

            function generarDatosEjemplo() {
                console.log('Generando datos de ejemplo...');
                const ahora = new Date();
                const datos = [];

                for (let i = 20; i >= 0; i--) {
                    const tiempo = new Date(ahora);
                    tiempo.setMinutes(tiempo.getMinutes() - i * 5);
                    datos.push({
                        created_at: tiempo.toISOString(),
                        valor: Math.random() * 10 + 5 // Valores entre 5-15
                    });
                }

                return {
                    ph: datos.map(d => ({...d, valor: Math.random() * 3 + 6.5})), // 6.5-9.5
                    conductividad: datos.map(d => ({...d, valor: Math.random() * 500 + 200})), // 200-700
                    temperatura: datos.map(d => ({...d, valor: Math.random() * 15 + 18})), // 18-33
                    turbidez: datos.map(d => ({...d, valor: Math.random() * 8 + 2})) // 2-10
                };
            }

            function procesarDatosParaGraficas(historico) {
                console.log('Procesando datos para gráficas:', historico);

                // Procesar datos de pH (con zonas)
                if (historico.ph && historico.ph.length > 0) {
                    const labelsPH = historico.ph.map(item =>
                        new Date(item.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})
                    );
                    const valoresPH = historico.ph.map(item => item.valor);
                    crearGraficaConZonas("graficaPH", labelsPH, valoresPH, ZONAS.ph, COLORES.ph, "pH");
                }

                // Procesar datos de temperatura (con zonas)
                if (historico.temperatura && historico.temperatura.length > 0) {
                    const labelsTemp = historico.temperatura.map(item =>
                        new Date(item.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})
                    );
                    const valoresTemp = historico.temperatura.map(item => item.valor);
                    crearGraficaConZonas("grafica-temperatura", labelsTemp, valoresTemp, ZONAS.temperatura, COLORES.temperatura, "°C");
                }

                // Procesar datos de conductividad (CON LÍNEAS GUÍA)
                if (historico.conductividad && historico.conductividad.length > 0) {
                    const labelsCond = historico.conductividad.map(item =>
                        new Date(item.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})
                    );
                    const valoresCond = historico.conductividad.map(item => item.valor);
                    crearGraficaConLineasGuia("grafica-conductividad", labelsCond, valoresCond, LINEAS_GUIA.conductividad, COLORES.conductividad, "µS/cm");
                }

                // Procesar datos de turbidez (CON LÍNEAS GUÍA)
                if (historico.turbidez && historico.turbidez.length > 0) {
                    const labelsTurb = historico.turbidez.map(item =>
                        new Date(item.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})
                    );
                    const valoresTurb = historico.turbidez.map(item => item.valor);
                    crearGraficaConLineasGuia("grafica-turbidez", labelsTurb, valoresTurb, LINEAS_GUIA.turbidez, COLORES.turbidez, "NTU");
                }
            }

            async function inicializarGraficas() {
                try {
                    const idBoya = document.getElementById('grafica-conductividad')?.dataset?.id;
                    if (!idBoya) {
                        console.error('No se pudo obtener el ID de la boya');
                        return;
                    }

                    console.log('Inicializando gráficas para boya:', idBoya);
                    const historico = await obtenerDatosHistoricos(idBoya);
                    procesarDatosParaGraficas(historico);
                } catch (error) {
                    console.error('Error inicializando gráficas:', error);
                }
            }

            // ======================
            // FUNCIONALIDAD ORIGINAL (DATOS ACTUALES)
            // ======================

            document.addEventListener('DOMContentLoaded', function() {
                const idBoya = document.getElementById('grafica-conductividad')?.dataset?.id;
                const apiBase = '{{ url("/api") }}';
                const lastUpdateElement = document.getElementById('last-update');

                const f = v => (v != null && !isNaN(v)) ? Number(v).toFixed(2) : "--";

                function updateTimestamp() {
                    if (lastUpdateElement) {
                        lastUpdateElement.textContent = "Actualizado: " + new Date().toLocaleTimeString();
                    }
                }

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

                function actualizarCampo(id, valor, rangos) {
                    const el = document.getElementById(id);
                    const v = Number(valor);

                    if (!el || isNaN(v)) {
                        el.innerHTML = ⁠ <i class="fas fa-question-circle text-gray-400 mr-1"></i>Sin datos ⁠;
                        return;
                    }

                    const r = rangos.find(r => v >= r.min && v <= r.max);
                    el.innerHTML = ⁠ <i class="fas ${r.icon} mr-1 ${r.color}"></i><span class="${r.color}">${r.texto}</span> ⁠;
                }

                function diagnosticoGlobal(vals) {
                    const panel = document.getElementById("diagnostico-general");
                    const texto = document.getElementById("diagnostico-texto");
                    const desc = document.getElementById("diagnostico-descripcion");

                    if (!panel || !texto || !desc) return;

                    const estados = [];
                    function pushEstado(param, v) {
                        const r = RANGOS[param].find(r => v >= r.min && v <= r.max);
                        estados.push(r.texto);
                    }

                    pushEstado("ph", vals.ph);
                    pushEstado("temperatura", vals.temperatura);
                    pushEstado("conductividad", vals.conductividad);
                    pushEstado("turbidez", vals.turbidez);

                    const malos = estados.filter(e => e === "Crítico" || e === "Bacteriológico").length;
                    const mantenimiento = estados.filter(e => e === "Mantenimiento").length;

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

                async function obtenerUltimoRegistro() {
                    try {
                        const res = await fetch(⁠ ${apiBase}/boya/${idBoya}/ultimo-registro ⁠);
                        if (!res.ok) throw new Error();
                        const d = await res.json();

                        // Actualizar datos
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
                        console.error('Error obteniendo último registro:', err);
                    }
                }

                async function actualizarTodo() {
                    await obtenerUltimoRegistro();
                    updateTimestamp();
                }

                // Inicializar
                if (idBoya) {
                    actualizarTodo();
                    setInterval(actualizarTodo, 10000);

                    // Inicializar gráficas después de un breve delay
                    setTimeout(inicializarGraficas, 500);
                }
            });
        </script>

        <style>
            .animate-pulse { animation: pulse 1s ease-in-out; }
            @keyframes pulse { 0% { opacity: 1; } 50% { opacity: .7; } 100% { opacity: 1; } }

            .contenedor-grafica {
                position: relative;
                width: 100% !important;
                height: 320px !important;
            }

            .contenedor-grafica::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, transparent, rgba(10, 117, 209, 0.02));
                border-radius: 8px;
            }

            .status-warning { color: #f59e0b; }
            .status-danger { color: #ef4444; }
            .status-optimal { color: #10b981; }
        </style>
    @endpush
</x-app-layout>
