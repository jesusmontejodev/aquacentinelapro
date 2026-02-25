<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class BoyaController extends Controller
{
    public function index()
    {
        $misboyas = Boya::where('id_user', Auth::id())->get();

        return view('boya.index', compact('misboyas'));
    }

    public function edit()
    {

    }

    public function show($id)
    {
        $boya = Boya::find($id);

        return view('boya.show', compact('boya'));
    }

    /**
     * Show the form to claim a boya
     */
    public function claim()
    {
        return view('boya.claim');
    }

    /**
     * Process boya claim request
     */
    public function claimStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'codigo_de_canjeo' => 'required|string|exists:boyas,codigo_de_canjeo',
        ], [
            'codigo_de_canjeo.required' => 'El código es requerido',
            'codigo_de_canjeo.exists' => 'El código ingresado no es válido',
        ]);

        // Buscar la boya con ese código
        $boya = Boya::where('codigo_de_canjeo', $validated['codigo_de_canjeo'])->first();

        // Verificar si la boya ya tiene usuario
        if ($boya->id_user !== null) {
            return back()->with('error', 'Esta boya ya ha sido reclamada por otro usuario');
        }

        // Asignar la boya al usuario actual
        $boya->id_user = Auth::id();
        $boya->save();

        return redirect()->route('boya.index')
            ->with('success', 'Boya reclamada exitosamente');
    }
}
