<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Monitoreo de Boya</h1>
            <span id="last-update" class="text-sm text-gray-500">Cargando...</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="p-4 bg-white shadow rounded">
                <p class="text-sm text-gray-500">Conductividad</p>
                <p id="conductividad-data" class="text-xl font-bold">--</p>
                <div id="conductividad-status" class="text-xs"></div>
            </div>
            <div class="p-4 bg-white shadow rounded">
                <p class="text-sm text-gray-500">pH</p>
                <p id="pH-data" class="text-xl font-bold">--</p>
                <div id="ph-status" class="text-xs"></div>
            </div>
            <div class="p-4 bg-white shadow rounded">
                <p class="text-sm text-gray-500">Temperatura</p>
                <p id="temperatura-data" class="text-xl font-bold">--</p>
                <div id="temperatura-status" class="text-xs"></div>
            </div>
            <div class="p-4 bg-white shadow rounded">
                <p class="text-sm text-gray-500">Turbidez</p>
                <p id="turbidez-data" class="text-xl font-bold">--</p>
                <div id="turbidez-status" class="text-xs"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold mb-2">Conductividad (µS/cm)</h3>
                <div id="grafica-conductividad" data-id="{{ $boya->id }}" style="height: 300px;"></div>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold mb-2">pH</h3>
                <div id="graficaPH" style="height: 300px;"></div>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold mb-2">Temperatura (°C)</h3>
                <div id="grafica-temperatura" style="height: 300px;"></div>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-bold mb-2">Turbidez (NTU)</h3>
                <div id="grafica-turbidez" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const idBoya = document.getElementById('grafica-conductividad').dataset.id;
            const apiBase = '{{ url("/api") }}';
            const chartInstances = {};

            // 1. Configuración de Gráfica (Sintaxis V4)
            function initChart(containerId, color) {
                const container = document.getElementById(containerId);
                const chart = LightweightCharts.createChart(container, {
                    width: container.clientWidth,
                    height: 300,
                    layout: { background: { color: '#ffffff' }, textColor: '#333' },
                    timeScale: { timeVisible: true, secondsVisible: false },
                });

                const series = chart.addSeries(LightweightCharts.AreaSeries, {
                    lineColor: color,
                    topColor: color + '44',
                    bottomColor: color + '00',
                    lineWidth: 2,
                });

                window.addEventListener('resize', () => {
                    chart.applyOptions({ width: container.clientWidth });
                });

                return { chart, series };
            }

            // 2. Función para actualizar todo
            async function refreshAll() {
                try {
                    // Obtener último registro (Tarjetas)
                    const resReg = await fetch(`${apiBase}/boya/${idBoya}/ultimo-registro`);
                    const d = await resReg.json();
                    
                    document.getElementById("conductividad-data").textContent = d.conductividad || "--";
                    document.getElementById("pH-data").textContent = d.ph || "--";
                    document.getElementById("temperatura-data").textContent = d.temperatura || "--";
                    document.getElementById("turbidez-data").textContent = d.turbidez || "--";

                    // Obtener Histórico (Gráficas)
                    const resHist = await fetch(`${apiBase}/boya/${idBoya}/historico`);
                    const hist = await resHist.json();

                    const config = [
                        { id: 'grafica-conductividad', key: 'conductividad', color: '#2563eb' },
                        { id: 'graficaPH', key: 'ph', color: '#16a34a' },
                        { id: 'grafica-temperatura', key: 'temperatura', color: '#ea580c' },
                        { id: 'grafica-turbidez', key: 'turbidez', color: '#9333ea' }
                    ];

                    config.forEach(c => {
                        if (!chartInstances[c.id]) {
                            chartInstances[c.id] = initChart(c.id, c.color);
                        }
                        
                        // Formatear datos: Lightweight Charts usa 'time' en segundos (Unix)
                        const rawData = hist[c.key] || [];
                        const formatted = rawData.map(r => ({
                            time: Math.floor(new Date(r.created_at).getTime() / 1000),
                            value: parseFloat(r.valor)
                        })).sort((a, b) => a.time - b.time);

                        if (formatted.length > 0) {
                            chartInstances[c.id].series.setData(formatted);
                            chartInstances[c.id].chart.timeScale().fitContent();
                        }
                    });

                    document.getElementById('last-update').textContent = "Actualizado: " + new Date().toLocaleTimeString();

                } catch (e) {
                    console.error("Error cargando datos:", e);
                }
            }

            // Ejecución inicial y ciclo
            refreshAll();
            setInterval(refreshAll, 10000);
        });
    </script>
    @endpush
</x-app-layout>