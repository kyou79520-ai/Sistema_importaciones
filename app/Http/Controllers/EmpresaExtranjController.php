<?php

class EmpresaExtranjController extends Controller
{
    public function index()
    {
        $empresas = EmpresaExtranjera::paginate(10);
        return view('empresa_extranjera.index', compact('empresas'));
    }
    public function create() { return view('empresa_extranjera.create'); }
    public function store(Request $request)
    {
        $request->validate(['nombre_empresa' => 'required', 'pais_origen' => 'required']);
        EmpresaExtranjera::create($request->all());
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa registrada.');
    }
    public function edit(EmpresaExtranjera $empresa)
    {
        return view('empresa_extranjera.edit', compact('empresa'));
    }
    public function update(Request $request, EmpresaExtranjera $empresa)
    {
        $empresa->update($request->all());
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa actualizada.');
    }
    public function destroy(EmpresaExtranjera $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresa-extranjera.index')->with('mensaje', 'Empresa eliminada.');
    }
}