import { createChart, ColorType } from 'lightweight-charts';

let chartTemp = null;
let lineSeriesTemp = null;
let areaSeriesTemp = null;

export async function graficaTemperaturaBoya(idBoya, url) {
    try {
        const response = await fetch(`${url}/api/temperatura/boya/${idBoya}`);
        const result = await response.json();

        if (!result.data || !Array.isArray(result.data)) {
            console.error('Error: formato de datos incorrecto', result);
            return;
        }

        // 🔹 Convertir y ordenar los datos por fecha
        const chartData = result.data
            .map((item) => ({
                time: Math.floor(new Date(item.created_at).getTime() / 1000),
                value: parseFloat(item.nivel_temperatura),
            }))
            .sort((a, b) => a.time - b.time);

        const chartContainer = document.getElementById('grafica-temperatura');
        if (!chartContainer) {
            console.error('Contenedor de gráfico no encontrado');
            return;
        }

        // ✅ Crear el gráfico solo una vez
        if (!chartTemp) {
            chartTemp = createChart(chartContainer, {
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

            // 🔸 Serie de línea principal
            lineSeriesTemp = chartTemp.addLineSeries({
                color: '#f59e0b', // naranja dorado (más representativo de temperatura)
                lineWidth: 3,
                crosshairMarkerVisible: true,
            });

            // 🔸 Serie de área sombreada
            areaSeriesTemp = chartTemp.addAreaSeries({
                topColor: 'rgba(245, 158, 11, 0.3)',
                bottomColor: 'rgba(245, 158, 11, 0.05)',
                lineColor: '#f59e0b',
                lineWidth: 2,
            });

            // 📱 Redimensionamiento responsivo
            window.addEventListener('resize', () => {
                chartTemp.applyOptions({ width: chartContainer.clientWidth });
            });
        }

        // 🔁 Actualizar datos sin recrear el gráfico
        lineSeriesTemp.setData(chartData);
        areaSeriesTemp.setData(chartData);

    } catch (error) {
        console.error('Error al obtener los datos de temperatura:', error);
    }
}

if (typeof window !== 'undefined') {
    window.graficaTemperaturaBoya = graficaTemperaturaBoya;
}
