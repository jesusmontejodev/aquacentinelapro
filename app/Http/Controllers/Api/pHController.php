<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\pH;

class pHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showAllBoya($id)
    {
        // Obtener todos los registros del modelo pH que coincidan con el id_boya
        $pH = pH::where('id_boya', $id)
                ->orderBy('created_at', 'asc') // ordenar por fecha descendente
                ->get();

        // Verificar si existen registros
        if ($pH->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros para esta boya.'
            ], 404);
        }

        // Retornar los datos en formato JSON
        return response()->json([
            'message' => 'Registros obtenidos correctamente.',
            'data' => $pH
        ], 200);
    }

}
