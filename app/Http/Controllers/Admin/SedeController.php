<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index()
    {
        $sedes = Sede::withCount('reservas')->get();
        return view('admin.sedes', compact('sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        Sede::create($request->only(['nombre', 'direccion']));

        return redirect()->route('admin.sedes')->with('success', 'Sede creada exitosamente.');
    }
}