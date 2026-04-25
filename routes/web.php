<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ImportacionController;
use App\Http\Controllers\ItemImportacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AgenteAduanalController;
use App\Http\Controllers\EmpresaExtranjController;
use App\Http\Controllers\EmpresaImportadoraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
 
// Raíz
Route::get('/', fn() => view('welcome'));
 
// Auth
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Auth::routes();
 
// Dashboard principal
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
// CRUD empleados (ya existente)
Route::resource('empleado', EmpleadoController::class);
 
// MÓDULO IMPORTACIONES
Route::resource('importacion', ImportacionController::class);
Route::post('importacion/{importacion}/estado', [ImportacionController::class, 'cambiarEstado'])
     ->name('importacion.estado');
 
// Items de importación
Route::post('importacion/{importacion}/items', [ItemImportacionController::class, 'store'])
     ->name('importacion.items.store');
Route::delete('items/{item}', [ItemImportacionController::class, 'destroy'])
     ->name('importacion.items.destroy');
 
// Documentos
Route::post('importacion/{importacion}/documentos', [DocumentoController::class, 'store'])
     ->name('importacion.documentos.store');
Route::post('documentos/{documento}/validar', [DocumentoController::class, 'validar'])
     ->name('documentos.validar');
Route::delete('documentos/{documento}', [DocumentoController::class, 'destroy'])
     ->name('documentos.destroy');
 
// Impuestos
Route::post('importacion/{importacion}/impuestos', [ImpuestoController::class, 'store'])
     ->name('importacion.impuestos.store');
Route::delete('impuestos/{impuesto}', [ImpuestoController::class, 'destroy'])
     ->name('impuestos.destroy');
 
// Pagos
Route::post('importacion/{importacion}/pagos', [PagoController::class, 'store'])
     ->name('importacion.pagos.store');
 
// Catálogos
Route::resource('agente-aduanal', AgenteAduanalController::class);
Route::resource('empresa-extranjera', EmpresaExtranjController::class);
Route::resource('empresa-importadora', EmpresaImportadoraController::class);