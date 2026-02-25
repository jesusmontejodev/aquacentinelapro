<?php

namespace App\Http\Controllers;

use App\Models\Boya;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBoyaController extends Controller
{
    /**
     * Display all boyas
     */
    public function index()
    {
        $boyas = Boya::with('user')->get();
        return view('admin.boyas.index', compact('boyas'));
    }

    /**
     * Show the form for creating a new boya
     */
    public function create()
    {
        $users = User::all();
        return view('admin.boyas.create', compact('users'));
    }

    /**
     * Store a newly created boya in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'codigo_de_canjeo' => 'required|string|unique:boyas',
            'nombre' => 'required|string|max:255',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'modelo' => 'required|string|max:255',
            'fecha_fabricacion' => 'required|date',
            'fecha_mantenimiento' => 'nullable|date',
        ]);

        Boya::create($validated);

        return redirect()->route('admin.boyas.index')
            ->with('success', 'Boya creada exitosamente');
    }

    /**
     * Show the form for editing the specified boya
     */
    public function edit(Boya $boya)
    {
        $users = User::all();
        return view('admin.boyas.edit', compact('boya', 'users'));
    }

    /**
     * Update the specified boya in database
     */
    public function update(Request $request, Boya $boya)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'codigo_de_canjeo' => 'required|string|unique:boyas,codigo_de_canjeo,' . $boya->id,
            'nombre' => 'required|string|max:255',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'modelo' => 'required|string|max:255',
            'fecha_fabricacion' => 'required|date',
            'fecha_mantenimiento' => 'nullable|date',
        ]);

        $boya->update($validated);

        return redirect()->route('admin.boyas.index')
            ->with('success', 'Boya actualizada exitosamente');
    }

    /**
     * Delete the specified boya from database
     */
    public function destroy(Boya $boya)
    {
        $boya->delete();

        return redirect()->route('admin.boyas.index')
            ->with('success', 'Boya eliminada exitosamente');
    }
}
