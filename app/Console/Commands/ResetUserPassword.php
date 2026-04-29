<?php

namespace App\Console\Commands;

use App\Models\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword extends Command
{
    /**
     * Uso:
     *   php artisan usuario:password admin
     *   php artisan usuario:password admin --password=NuevaPass123!
     */
    protected $signature = 'usuario:password
                            {usuario : nombre_usuario o email}
                            {--password= : nueva contraseña (si se omite, se pregunta)}';

    protected $description = 'Resetear la contraseña de un usuario y guardarla con bcrypt válido';

    public function handle(): int
    {
        $login = $this->argument('usuario');

        $usuario = Usuario::where('nombre_usuario', $login)
            ->orWhere('email', $login)
            ->first();

        if (!$usuario) {
            $this->error("No se encontró un usuario con: {$login}");
            return self::FAILURE;
        }

        $password = $this->option('password') ?: $this->secret('Nueva contraseña');

        if (strlen($password) < 8) {
            $this->error('La contraseña debe tener al menos 8 caracteres.');
            return self::FAILURE;
        }

        $usuario->hash_contrasena = Hash::make($password);
        $usuario->save();

        $this->info("Contraseña actualizada para {$usuario->nombre_usuario} ({$usuario->email})");
        $this->line("Hash generado: " . substr($usuario->hash_contrasena, 0, 30) . '...');

        return self::SUCCESS;
    }
}
