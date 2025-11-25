import { createChart, ColorType } from 'lightweight-charts';

export async function graficaTurbidezBoya(idBoya, url) {
    try {
        const response = await fetch(`${url}/api/turbidez/boya/${idBoya}`);
        const result = await response.json();

        if (!result.data || !Array.isArray(result.data)) {
            console.error('Error: formato de datos incorrecto', result);
            return;
        }

        const chartData = result.data
            .map((item) => ({
                time: Math.floor(new Date(item.created_at).getTime() / 1000),
                value: parseFloat(item.nivel_turbidez),
            }))
            .filter(item => !isNaN(item.value))
            .sort((a, b) => a.time - b.time);

        const chartContainer = document.getElementById('grafica-turbidez');
        if (!chartContainer) {
            console.error('Contenedor de gráfico no encontrado');
            return;
        }

        // Detectar modo oscuro automáticamente
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        const chart = createChart(chartContainer, {
            width: chartContainer.clientWidth,
            height: 400,
            layout: {
                background: { type: ColorType.Solid, color: prefersDark ? '#0f172a' : '#f9fafb' },
                textColor: prefersDark ? '#e2e8f0' : '#333',
            },
            grid: {
                vertLines: { color: prefersDark ? '#1e293b' : '#e0e0e0' },
                horzLines: { color: prefersDark ? '#1e293b' : '#e0e0e0' },
            },
            crosshair: { mode: 1 },
            rightPriceScale: { borderVisible: false },
            timeScale: {
                timeVisible: true,
                secondsVisible: false,
                borderVisible: false,
            },
        });

        const areaSeries = chart.addAreaSeries({
            topColor: prefersDark ? 'rgba(159, 33, 255, 0.6)' : '#9f21ffff',
            bottomColor: prefersDark ? 'rgba(159, 33, 255, 0.05)' : 'rgba(79, 70, 229, 0.05)',
            lineColor: '#ad5affff',
            lineWidth: 2,
        });

        // Efecto de “animación” al cargar los datos
        let index = 0;
        const animatedData = [];
        const interval = setInterval(() => {
            if (index < chartData.length) {
                animatedData.push(chartData[index]);
                areaSeries.setData(animatedData);
                index++;
            } else {
                clearInterval(interval);
            }
        }, 50);

        // Redimensionamiento responsivo
        window.addEventListener('resize', () => {
            chart.applyOptions({ width: chartContainer.clientWidth });
        });

    } catch (error) {
        console.error('Error al obtener los datos:', error);
    }
}

if (typeof window !== 'undefined') {
    window.graficaTurbidezBoya = graficaTurbidezBoya;
}
