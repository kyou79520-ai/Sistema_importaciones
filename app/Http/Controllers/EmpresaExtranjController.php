<?php

namespace App\Http\Controllers;

// ============================================================
// ARCHIVO: app/Http/Controllers/EmpresaExtranjController.php
// ============================================================
use App\Models\EmpresaExtranjera;
use Illuminate\Http\Request;

class EmpresaExtranjController extends Controller
{
    public function index()
    {
        $empresas = EmpresaExtranjera::paginate(10);
        return view('empresa_extranjera.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresa_extranjera.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|max:200',
            'pais_origen'    => 'required|max:100',
            'moneda_default' => 'nullable|max:10',
            'num_tax_id'     => 'nullable|max:50',
        ]);

        EmpresaExtranjera::create($request->all());
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa registrada.');
    }

    public function edit(EmpresaExtranjera $empresaExtranjera)
    {
        return view('empresa_extranjera.edit', ['empresa' => $empresaExtranjera]);
    }

    public function update(Request $request, EmpresaExtranjera $empresaExtranjera)
    {
        $request->validate([
            'nombre_empresa' => 'required|max:200',
            'pais_origen'    => 'required|max:100',
        ]);

        $empresaExtranjera->update($request->all());
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa actualizada.');
    }

    public function destroy(EmpresaExtranjera $empresaExtranjera)
    {
        $empresaExtranjera->delete();
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa eliminada.');
    }
}