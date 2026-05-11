<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    /**
     * En Laravel 11+ el middleware 'guest' se aplica en routes/web.php,
     * NO en el constructor.
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_usuario'  => ['required', 'string', 'max:50', 'unique:usuario,nombre_usuario'],
            'nombre_completo' => ['required', 'string', 'max:150'],
            'email'           => ['required', 'string', 'email', 'max:150', 'unique:usuario,email'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Usuario::create([
            'nombre_usuario'  => $data['nombre_usuario'],
            'nombre_completo' => $data['nombre_completo'],
            'email'           => $data['email'],
            'hash_contrasena' => Hash::make($data['password']),
            'activo'          => true,
        ]);
    }
}
