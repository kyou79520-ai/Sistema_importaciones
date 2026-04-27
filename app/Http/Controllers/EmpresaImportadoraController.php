<?php

namespace App\Http\Controllers;

use App\Models\EmpresaImportadora;
use Illuminate\Http\Request;

class EmpresaImportadoraController extends Controller
{
    public function index()
    {
        $empresas = EmpresaImportadora::paginate(10);
        return view('empresa_importadora.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresa_importadora.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'RFC_empresa'  => 'required|unique:empresa_importadora|max:13',
            'razon_social' => 'required|max:200',
            'giro_comercial' => 'nullable|max:150',
        ]);

        EmpresaImportadora::create([
            'RFC_empresa'         => $request->RFC_empresa,
            'razon_social'        => $request->razon_social,
            'padron_importadores' => $request->boolean('padron_importadores'),
            'giro_comercial'      => $request->giro_comercial,
        ]);

        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa importadora registrada.');
    }

    public function edit(EmpresaImportadora $empresaImportadora)
    {
        return view('empresa_importadora.edit', ['empresa' => $empresaImportadora]);
    }

    public function update(Request $request, EmpresaImportadora $empresaImportadora)
    {
        $request->validate([
            'RFC_empresa'  => 'required|max:13|unique:empresa_importadora,RFC_empresa,' . $empresaImportadora->id_empresa_mx . ',id_empresa_mx',
            'razon_social' => 'required|max:200',
        ]);

        $empresaImportadora->update([
            'RFC_empresa'         => $request->RFC_empresa,
            'razon_social'        => $request->razon_social,
            'padron_importadores' => $request->boolean('padron_importadores'),
            'giro_comercial'      => $request->giro_comercial,
        ]);

        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa actualizada.');
    }

    public function destroy(EmpresaImportadora $empresaImportadora)
    {
        $empresaImportadora->delete();
        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa eliminada.');
    }
}