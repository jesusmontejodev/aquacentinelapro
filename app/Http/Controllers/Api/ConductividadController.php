<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Conductividad;

class ConductividadController extends Controller
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

    public function showConductividadBoya( $id ){

        $conductividad = Conductividad::where( 'id_boya', $id )
            ->orderBy('created_at', 'asc')
            ->get();

        if ( $conductividad->isEmpty() ) {
            return response()->json( [
                'message' => 'No se encontro conductividad para esta boya'
            ], 404 );
        }

        return response()->json([
            'message' => 'Registros obtenidos correctamente.',
            'data' => $conductividad
        ], 200);

    }
}
