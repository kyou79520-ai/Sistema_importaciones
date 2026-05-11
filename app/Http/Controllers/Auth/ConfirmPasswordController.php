<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = '/dashboard';

    // Sin __construct(): el middleware 'auth' se aplica en routes/web.php.
}
