<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BoyaController;
use App\Http\Controllers\Api\pHController;
use App\Http\Controllers\Api\ConductividadController;
use App\Http\Controllers\Api\TemperaturaController;
use App\Http\Controllers\Api\TurbidezController;


// Ruta de prueba básica
Route::get('/test', function () {
    return response()->json([
        'message' => '¡La API está funcionando!',
        'status' => 'success',
        'timestamp' => now()
    ]);
});

// Ruta con parámetro
Route::get('/hello', function () {
    return response()->json([
        'message' => "Hola Jesus desde la API",
        'saludo' => '¡Bienvenido!'
    ]);
});

// Ruta POST de ejemplo
Route::post('/echo', function () {
    return response()->json([
        'received_data' => request()->all(),
        'message' => 'Datos recibidos correctamente'
    ]);
});



Route::post('/sensores', [BoyaController::class, 'store']);

Route::post('/ph', [pHController::class, 'store']);
Route::get('/boya/diagnostico/{id}', [BoyaController::class, 'diagnostico']);
Route::get('/boya/{id}/ultimo-registro', [BoyaController::class, 'ultimoRegistro']);

Route::get('/boya/{id}/historico', [BoyaController::class, 'historico']);
Route::get('/boya/info/{id}', [BoyaController::class, 'show']);
Route::get('/ph/boya/{id}', [pHController::class, 'showAllBoya']);
Route::get('/conductividad/boya/{id}', [ConductividadController::class, 'showConductividadBoya']);
Route::get('/temperatura/boya/{id}', [TemperaturaController::class, 'showTemperaturaBoya']);
Route::get('/turbidez/boya/{id}', [TurbidezController::class, 'showTurbidezBoya']);
