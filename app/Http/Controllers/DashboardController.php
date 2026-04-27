<?php

namespace App\Http\Controllers;

use App\Models\Importacion;
use App\Models\Pago;
use App\Models\Documento;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_importaciones' => Importacion::count(),
            'en_tramite'          => Importacion::where('estado', 'en_tramite')->count(),
            'en_aduana'           => Importacion::where('estado', 'en_aduana')->count(),
            'liberadas'           => Importacion::where('estado', 'liberada')->count(),
            'total_pagos'         => Pago::sum('monto'),
            'docs_pendientes'     => Documento::where('validado', false)->count(),
        ];

        $recientes = Importacion::with('empresaExtranjera')
                                ->orderByDesc('created_at')
                                ->limit(5)
                                ->get();

        return view('dashboard', compact('stats', 'recientes'));
    }
}