<?php

class AgenteAduanalController extends Controller
{
    public function index()
    {
        $agentes = AgenteAduanal::withCount('importaciones')->paginate(10);
        return view('agente_aduanal.index', compact('agentes'));
    }
 
    public function create()
    {
        return view('agente_aduanal.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nombre_agente'   => 'required',
            'num_patente'     => 'required|unique:agente_aduanal',
            'aduana_adscrita' => 'required',
        ]);
        AgenteAduanal::create($request->all());
        return redirect()->route('agente-aduanal.index')->with('mensaje', 'Agente aduanal registrado.');
    }
 
    public function edit(AgenteAduanal $agenteAduanal)
    {
        return view('agente_aduanal.edit', ['agente' => $agenteAduanal]);
    }
 
    public function update(Request $request, AgenteAduanal $agenteAduanal)
    {
        $agenteAduanal->update($request->all());
        return redirect()->route('agente-aduanal.index')->with('mensaje', 'Agente actualizado.');
    }
 
    public function destroy(AgenteAduanal $agenteAduanal)
    {
        $agenteAduanal->delete();
        return redirect()->route('agente-aduanal.index')->with('mensaje', 'Agente eliminado.');
    }
}