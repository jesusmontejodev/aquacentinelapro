import { createChart, ColorType } from 'lightweight-charts';

let chartPh = null;
let lineSeriesPh = null;
let areaSeriesPh = null;

export async function graficaPhBoya(idBoya, url) {
    try {
        const response = await fetch(`${url}/api/ph/boya/${idBoya}`);
        const result = await response.json();

        if (!result.data || !Array.isArray(result.data)) {
            console.error('Error: formato de datos incorrecto', result);
            return;
        }

        // 🔹 Formatear y ordenar los datos
        const chartData = result.data
            .map((item) => ({
                time: Math.floor(new Date(item.created_at).getTime() / 1000),
                value: parseFloat(item.nivel_ph),
            }))
            .sort((a, b) => a.time - b.time);

        const chartContainer = document.getElementById('grafica-ph');
        if (!chartContainer) {
            console.error('Contenedor de gráfico no encontrado');
            return;
        }

        // ✅ Crear el gráfico una sola vez
        if (!chartPh) {
            chartPh = createChart(chartContainer, {
                width: chartContainer.clientWidth,
                height: 400,
                layout: {
                    background: { type: ColorType.Solid, color: '#f9fafb' },
                    textColor: '#333',
                },
                grid: {
                    vertLines: { color: '#e0e0e0', style: 1 },
                    horzLines: { color: '#e0e0e0', style: 1 },
                },
                crosshair: { mode: 1 },
                rightPriceScale: { borderVisible: false },
                timeScale: {
                    timeVisible: true,
                    secondsVisible: false,
                    borderVisible: false,
                },
            });

            // Serie de línea principal
            lineSeriesPh = chartPh.addLineSeries({
                color: '#16a34a', // verde vibrante para pH
                lineWidth: 3,
                crosshairMarkerVisible: true,
            });

            // Área sombreada debajo
            areaSeriesPh = chartPh.addAreaSeries({
                topColor: 'rgba(22, 163, 74, 0.3)',
                bottomColor: 'rgba(22, 163, 74, 0.05)',
                lineColor: '#16a34a',
                lineWidth: 2,
            });

            // 🔹 Redimensionamiento dinámico
            window.addEventListener('resize', () => {
                chartPh.applyOptions({ width: chartContainer.clientWidth });
            });
        }

        // ✅ Actualizar datos sin recrear el gráfico
        lineSeriesPh.setData(chartData);
        areaSeriesPh.setData(chartData);

    } catch (error) {
        console.error('Error al obtener los datos de pH:', error);
    }
}

if (typeof window !== 'undefined') {
    window.graficaPhBoya = graficaPhBoya;
}
