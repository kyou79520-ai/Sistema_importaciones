<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección tras login exitoso.
     */
    protected $redirectTo = '/dashboard';

    /**
     * En Laravel 11+ el middleware se aplica en routes/web.php,
     * NO en el constructor. Por eso aquí no hay __construct().
     */

    /**
     * El campo de identificación: aceptamos email o nombre_usuario.
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Sobrescribimos las credenciales para soportar login con email O nombre_usuario.
     */
    protected function credentials(Request $request)
    {
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nombre_usuario';

        return [
            $field     => $login,
            'password' => $request->input('password'),
            'activo'   => true,  // bloqueamos usuarios desactivados
        ];
    }

    /**
     * Reglas de validación del formulario de login.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Tras autenticarse, registramos el último acceso.
     */
    protected function authenticated(Request $request, $user)
    {
        $user->update(['ultimo_acceso' => now()]);
    }
}
