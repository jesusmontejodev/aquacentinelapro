<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boya;
use App\Models\pH;
use App\Models\Conductividad;
use App\Models\Temperatura;
use App\Models\Turbidez;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BoyaController extends Controller
{
    // ================================
    //  CRUD ORIGINAL (SE MANTIENE)
    // ================================

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_boya' => 'required|integer|exists:boyas,id',
                'nivel_ph' => 'required|numeric',
                'nivel_conductividad' => 'required|numeric|min:0',
                'nivel_turbidez' => 'required|numeric|min:0',
                'nivel_temperatura' => 'required|numeric'
            ]);

            DB::beginTransaction();

            $ph = pH::create([
                'id_boya' => $validated['id_boya'],
                'nivel_ph' => $validated['nivel_ph']
            ]);

            $conductividad = Conductividad::create([
                'id_boya' => $validated['id_boya'],
                'nivel_conductividad' => $validated['nivel_conductividad']
            ]);

            $turbidez = Turbidez::create([
                'id_boya' => $validated['id_boya'],
                'nivel_turbidez' => $validated['nivel_turbidez']
            ]);

            $temperatura = Temperatura::create([
                'id_boya' => $validated['id_boya'],
                'nivel_temperatura' => $validated['nivel_temperatura']
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Datos de la boya registrados exitosamente',
                'data' => [
                    'ph' => $ph,
                    'conductividad' => $conductividad,
                    'turbidez' => $turbidez,
                    'temperatura' => $temperatura
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar datos de la boya: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        $pH = pH::where('id_boya', $id)->orderBy('id','desc')->first();
        $conductividad = Conductividad::where('id_boya', $id)->orderBy('id','desc')->first();
        $temperatura = Temperatura::where('id_boya', $id)->orderBy('id','desc')->first();
        $turbidez = Turbidez::where('id_boya', $id)->orderBy('id','desc')->first();

        return response()->json([
            'message' => 'Últimos registros de la boya',
            'data' => [
                'ph' => $pH,
                'conductividad' => $conductividad,
                'temperatura' => $temperatura,
                'turbidez' => $turbidez
            ]
        ], 200);
    }

    // ============================================
    //   DIAGNÓSTICO NUEVO (LÓGICA DIFUSA OPTIMIZADA)
    // ============================================

    public function diagnostico($id)
    {
        // Obtener últimos registros por ID
        $ph = pH::where('id_boya', $id)->orderBy('id','desc')->first();
        $temperatura = Temperatura::where('id_boya', $id)->orderBy('id','desc')->first();
        $turbidez = Turbidez::where('id_boya', $id)->orderBy('id','desc')->first();
        $conductividad = Conductividad::where('id_boya', $id)->orderBy('id','desc')->first();

        if (!$ph || !$temperatura || !$turbidez || !$conductividad) {
            return response()->json([
                'message' => 'Faltan datos para generar diagnóstico'
            ], 404);
        }

        // Scores difusos
        $scorePh = $this->scorePh($ph->nivel_ph);
        $scoreTemp = $this->scoreTemperature($temperatura->nivel_temperatura);
        $scoreTurb = $this->scoreTurbidity($turbidez->nivel_turbidez);
        $scoreCond = $this->scoreConductivity($conductividad->nivel_conductividad);

        $puntajeTotal = $scorePh + $scoreTemp + $scoreTurb + $scoreCond;

        return response()->json([
            'parametros' => [
                'ph' => ['valor' => $ph->nivel_ph, 'score' => $scorePh],
                'temperatura' => ['valor' => $temperatura->nivel_temperatura, 'score' => $scoreTemp],
                'turbidez' => ['valor' => $turbidez->nivel_turbidez, 'score' => $scoreTurb],
                'conductividad' => ['valor' => $conductividad->nivel_conductividad, 'score' => $scoreCond],
            ],
            'puntaje_total' => $puntajeTotal,
            'estado' => $this->diagnosticLevel($puntajeTotal),
            'recomendacion' => $this->recommendation($puntajeTotal)
        ]);
    }

    // ============================
    // FUNCIONES DIFUSAS
    // ============================

    private function scorePh($ph)
    {
        if ($ph >= 6.5 && $ph <= 8.5) return 0;
        if ($ph >= 6.0 && $ph <= 9.0) return 1;
        return 2;
    }

    private function scoreConductivity($c)
    {
        if ($c <= 500) return 0;
        if ($c <= 1500) return 1;
        return 2;
    }

    private function scoreTurbidity($t)
    {
        if ($t <= 1) return 0;
        if ($t <= 5) return 1;
        return 2;
    }

    private function scoreTemperature($temp)
    {
        if ($temp >= 15 && $temp <= 25) return 0;
        if ($temp >= 10 && $temp <= 30) return 1;
        return 2;
    }

    private function diagnosticLevel($score)
    {
        if ($score <= 2) return "Bueno";
        if ($score <= 5) return "Regular";
        return "Malo";
    }

    private function recommendation($score)
    {
        if ($score <= 2) return "No requiere mantenimiento";
        if ($score <= 5) return "Requiere mantenimiento";
        if ($score <= 7) return "Requiere tratamiento químico";
        return "Requiere estudio bacteriológico";
    }

    // ======================================
    //   ÚLTIMO REGISTRO (YA ESTABA BIEN)
    // ======================================

    public function ultimoRegistro($id)
    {
        $pH = pH::where('id_boya', $id)->orderBy('id', 'desc')->first();
        $conductividad = Conductividad::where('id_boya', $id)->orderBy('id', 'desc')->first();
        $temperatura = Temperatura::where('id_boya', $id)->orderBy('id', 'desc')->first();
        $turbidez = Turbidez::where('id_boya', $id)->orderBy('id', 'desc')->first();

        return response()->json([
            'ph' => $pH?->nivel_ph,
            'conductividad' => $conductividad?->nivel_conductividad,
            'temperatura' => $temperatura?->nivel_temperatura,
            'turbidez' => $turbidez?->nivel_turbidez
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function historico($id)
    {
        return response()->json([
            'ph' => pH::where('id_boya', $id)->orderBy('id', 'asc')->get(['nivel_ph as valor', 'created_at']),
            'temperatura' => Temperatura::where('id_boya', $id)->orderBy('id', 'asc')->get(['nivel_temperatura as valor', 'created_at']),
            'turbidez' => Turbidez::where('id_boya', $id)->orderBy('id', 'asc')->get(['nivel_turbidez as valor', 'created_at']),
            'conductividad' => Conductividad::where('id_boya', $id)->orderBy('id', 'asc')->get(['nivel_conductividad as valor', 'created_at']),
        ]);
    }


    public function destroy(string $id)
    {
        //
    }
}
