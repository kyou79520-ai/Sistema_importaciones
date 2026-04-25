<?php

class EmpresaImportadoraController extends Controller
{
    public function index()
    {
        $empresas = EmpresaImportadora::paginate(10);
        return view('empresa_importadora.index', compact('empresas'));
    }
    public function create() { return view('empresa_importadora.create'); }
    public function store(Request $request)
    {
        $request->validate([
            'RFC_empresa'  => 'required|unique:empresa_importadora',
            'razon_social' => 'required',
        ]);
        EmpresaImportadora::create($request->all());
        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa importadora registrada.');
    }
    public function edit(EmpresaImportadora $empresa)
    {
        return view('empresa_importadora.edit', compact('empresa'));
    }
    public function update(Request $request, EmpresaImportadora $empresa)
    {
        $empresa->update($request->all());
        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa actualizada.');
    }
    public function destroy(EmpresaImportadora $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresa-importadora.index')->with('mensaje', 'Empresa eliminada.');
    }
}