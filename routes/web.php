<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ImportacionController;
use App\Http\Controllers\ItemImportacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CostoImportacionController;
use App\Http\Controllers\AgenteAduanalController;
use App\Http\Controllers\EmpresaExtranjController;
use App\Http\Controllers\EmpresaImportadoraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

// Raíz pública
Route::get('/', fn() => view('welcome'));

// Auth de Laravel (login, register, logout, password reset)
Auth::routes();

// Todo lo demás requiere login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/home',      [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Empleados
    Route::resource('empleado', EmpleadoController::class);

    // ── IMPORTACIONES ──────────────────────────────────────
    Route::resource('importacion', ImportacionController::class);
    Route::post('importacion/{importacion}/estado',
        [ImportacionController::class, 'cambiarEstado'])->name('importacion.estado');

    // Items de importación
    Route::post('importacion/{importacion}/items',
        [ItemImportacionController::class, 'store'])->name('importacion.items.store');
    Route::delete('items/{item}',
        [ItemImportacionController::class, 'destroy'])->name('importacion.items.destroy');

    // Documentos
    Route::post('importacion/{importacion}/documentos',
        [DocumentoController::class, 'store'])->name('importacion.documentos.store');
    Route::post('documentos/{documento}/validar',
        [DocumentoController::class, 'validar'])->name('documentos.validar');
    Route::delete('documentos/{documento}',
        [DocumentoController::class, 'destroy'])->name('documentos.destroy');

    // Impuestos
    Route::post('importacion/{importacion}/impuestos',
        [ImpuestoController::class, 'store'])->name('importacion.impuestos.store');
    Route::delete('impuestos/{impuesto}',
        [ImpuestoController::class, 'destroy'])->name('impuestos.destroy');

    // Pagos
    Route::post('importacion/{importacion}/pagos',
        [PagoController::class, 'store'])->name('importacion.pagos.store');
    Route::delete('pagos/{pago}',
        [PagoController::class, 'destroy'])->name('importacion.pagos.destroy');

    // Costos
    Route::post('importacion/{importacion}/costos',
        [CostoImportacionController::class, 'store'])->name('importacion.costos.store');
    Route::delete('costos/{costoImportacion}',
        [CostoImportacionController::class, 'destroy'])->name('importacion.costos.destroy');

    // ── CATÁLOGOS ──────────────────────────────────────────
    Route::resource('agente-aduanal',      AgenteAduanalController::class);
    Route::resource('empresa-extranjera',  EmpresaExtranjController::class);
    Route::resource('empresa-importadora', EmpresaImportadoraController::class);

    // ── ADMINISTRACIÓN ─────────────────────────────────────
    Route::resource('usuario', UsuarioController::class);
    Route::resource('rol',     RolController::class);
});