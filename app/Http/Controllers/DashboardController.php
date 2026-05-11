<?php

namespace App\Http\Controllers;

use App\Models\Importacion;
use App\Models\Documento;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pagos: solo si la tabla existe (es opcional)
        $totalPagos = Schema::hasTable('pago')
            ? (float) DB::table('pago')->sum('monto')
            : 0;

        $stats = [
            'total_importaciones' => Importacion::count(),
            'en_tramite'          => Importacion::whereIn('estado', ['en_tramite', 'En proceso'])->count(),
            'en_aduana'           => Importacion::where('estado', 'en_aduana')->count(),
            'liberadas'           => Importacion::where('estado', 'liberada')->count(),
            'total_pagos'         => $totalPagos,
            'docs_pendientes'     => Documento::where('validado', false)
                                              ->orWhereNull('validado')
                                              ->count(),
        ];

        $recientes = Importacion::with('empresaExtranjera')
                                ->orderByDesc('id_importacion')
                                ->limit(5)
                                ->get();

        return view('dashboard', compact('stats', 'recientes'));
    }
}
