import { createChart, ColorType } from 'lightweight-charts';

let chart = null;
let lineSeries = null;
let areaSeries = null;

export async function graficaConductividadBoya(idBoya, url) {
    try {
        const response = await fetch(`${url}/api/conductividad/boya/${idBoya}`);
        const result = await response.json();

        if (!result.data || !Array.isArray(result.data)) {
            console.error('Error: formato de datos incorrecto', result);
            return;
        }

        const chartData = result.data
            .map((item) => ({
                time: Math.floor(new Date(item.created_at).getTime() / 1000),
                value: parseFloat(item.nivel_conductividad),
            }))
            .sort((a, b) => a.time - b.time);

        const chartContainer = document.getElementById('grafica-conductividad');
        if (!chartContainer) {
            console.error('Contenedor no encontrado');
            return;
        }

        // 🧠 Solo crear el gráfico una vez
        if (!chart) {
            chart = createChart(chartContainer, {
                width: chartContainer.clientWidth,
                height: 400,
                layout: {
                    background: { type: ColorType.Solid, color: '#f9fafb' },
                    textColor: '#333',
                },
                grid: {
                    vertLines: { color: '#e0e0e0' },
                    horzLines: { color: '#e0e0e0' },
                },
                crosshair: { mode: 1 },
                rightPriceScale: { borderVisible: false },
                timeScale: { timeVisible: true, secondsVisible: false },
            });

            lineSeries = chart.addLineSeries({
                color: '#4f46e5',
                lineWidth: 3,
            });

            areaSeries = chart.addAreaSeries({
                topColor: 'rgba(79, 70, 229, 0.3)',
                bottomColor: 'rgba(79, 70, 229, 0.05)',
                lineColor: '#4f46e5',
                lineWidth: 2,
            });

            window.addEventListener('resize', () => {
                chart.applyOptions({ width: chartContainer.clientWidth });
            });
        }

        // 🔄 Solo actualizamos los datos
        lineSeries.setData(chartData);
        areaSeries.setData(chartData);

    } catch (error) {
        console.error('Error al obtener los datos:', error);
    }
}

if (typeof window !== 'undefined') {
    window.graficaConductividadBoya = graficaConductividadBoya;
}
