<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/empleado', function () {
    return view('empleado.index');
});

Route::get('/empleado/create', [EmpleadoController::class,'create']);
*/
Route::resource('empleado',EmpleadoController::class);

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
