<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
    protected $signature = 'usuarios:hash-passwords';
    protected $description = 'Hashea contraseñas en texto plano de la tabla usuario';

    public function handle()
    {
        $usuarios = DB::table('usuario')->get();

        foreach ($usuarios as $usuario) {
            $esBcrypt = preg_match('/^\$2[aby]\$\d{2}\$/', $usuario->hash_contrasena)
                        && strlen($usuario->hash_contrasena) === 60;

            if (!$esBcrypt) {
                DB::table('usuario')
                    ->where('id_usuario', $usuario->id_usuario)
                    ->update([
                        'hash_contrasena' => Hash::make($usuario->hash_contrasena)
                    ]);

                $this->info("Hasheado: {$usuario->nombre_usuario}");
            }
        }

        $this->info('Proceso completado.');
    }
}
