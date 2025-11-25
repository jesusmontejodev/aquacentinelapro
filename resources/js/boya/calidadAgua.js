// archivo: resources/js/boya/calidadAgua.js

export async function actualizarDatosCalidad(idBoya, apiUrl) {
    try {
        const response = await fetch(`${apiUrl}/api/boya/info/${idBoya}`);
        const result = await response.json();
        const data = result.data;

        if (!data) {
            console.warn('⚠️ No hay datos de la boya');
            return;
        }

        // Convertir valores numéricos
        const ph = parseFloat(data.ph.nivel_ph);
        const conductividad = parseFloat(data.conductividad.nivel_conductividad);
        const temperatura = parseFloat(data.temperatura.nivel_temperatura);
        const turbidez = parseFloat(data.turbidez.nivel_turbidez);

        // Push directo al DOM
        document.getElementById('pH-data').textContent = `${ph.toFixed(2)}`;
        document.getElementById('conductividad-data').textContent = `${conductividad.toFixed(2)} µS/cm`;
        document.getElementById('temperatura-data').textContent = `${temperatura.toFixed(2)} °C`;
        document.getElementById('turbidez-data').textContent = `${turbidez.toFixed(2)} NTU`;

        // Reglas para evaluar calidad del agua
        const evaluarParametro = (valor, bueno, regular) => {
            if (valor >= bueno[0] && valor <= bueno[1]) return "bueno";
            if (valor >= regular[0] && valor <= regular[1]) return "regular";
            return "malo";
        };

        const phEstado = evaluarParametro(ph, [6.5, 8.5], [6, 9]);
        const condEstado = evaluarParametro(conductividad, [50, 500], [30, 1000]);
        const tempEstado = evaluarParametro(temperatura, [10, 25], [5, 30]);
        const turbEstado = evaluarParametro(turbidez, [0, 5], [5, 20]);

        // Calcular score total
        let score = 0;
        for (const estado of [phEstado, condEstado, tempEstado, turbEstado]) {
            if (estado === "bueno") score += 2;
            else if (estado === "regular") score += 1;
        }

        // Determinar calidad global
        let calidad, color;
        if (score >= 7) {
            calidad = "🟢 Buena";
            color = "green";
        } else if (score >= 4) {
            calidad = "🟡 Regular";
            color = "gold";
        } else {
            calidad = "🔴 Mala";
            color = "red";
        }

        // Mostrar resultados en consola
        console.log(`Calidad del agua: %c${calidad}`, `color:${color}; font-weight:bold`);
        console.table({ ph, conductividad, temperatura, turbidez, phEstado, condEstado, tempEstado, turbEstado });

        // ✅ (Opcional) Si quieres mostrar calidad en pantalla:
        let calidadElemento = document.getElementById('calidad-agua');
        if (!calidadElemento) {
            calidadElemento = document.createElement('h3');
            calidadElemento.id = 'calidad-agua';
            calidadElemento.className = 'text-lg font-semibold mt-6';
            document.querySelector('.my-8').appendChild(calidadElemento);
        }
        calidadElemento.textContent = `Calidad del agua estimada: ${calidad}`;
        calidadElemento.style.color = color;

    } catch (error) {
        console.error('Error al obtener datos de la boya:', error);
    }
}
if (typeof window !== 'undefined') {
    window.actualizarDatosCalidad = actualizarDatosCalidad;
}
  