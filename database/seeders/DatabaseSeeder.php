<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\Usuario;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Permisos ──────────────────────────────────────────
        $permisos = [
            // Importaciones
            ['nombre' => 'importacion.ver',     'modulo' => 'importacion', 'descripcion' => 'Ver listado de importaciones'],
            ['nombre' => 'importacion.crear',   'modulo' => 'importacion', 'descripcion' => 'Crear nuevas importaciones'],
            ['nombre' => 'importacion.editar',  'modulo' => 'importacion', 'descripcion' => 'Editar importaciones'],
            ['nombre' => 'importacion.borrar',  'modulo' => 'importacion', 'descripcion' => 'Eliminar importaciones'],
            // Documentos
            ['nombre' => 'documento.subir',     'modulo' => 'documento',   'descripcion' => 'Subir documentos'],
            ['nombre' => 'documento.validar',   'modulo' => 'documento',   'descripcion' => 'Validar documentos'],
            ['nombre' => 'documento.borrar',    'modulo' => 'documento',   'descripcion' => 'Eliminar documentos'],
            // Pagos
            ['nombre' => 'pago.registrar',      'modulo' => 'pago',        'descripcion' => 'Registrar pagos'],
            // Catálogos
            ['nombre' => 'catalogo.ver',        'modulo' => 'catalogo',    'descripcion' => 'Ver catálogos'],
            ['nombre' => 'catalogo.gestionar',  'modulo' => 'catalogo',    'descripcion' => 'Crear/editar/borrar catálogos'],
            // Usuarios
            ['nombre' => 'usuario.gestionar',   'modulo' => 'admin',       'descripcion' => 'Gestionar usuarios'],
            ['nombre' => 'rol.gestionar',       'modulo' => 'admin',       'descripcion' => 'Gestionar roles y permisos'],
        ];
 
        $permisosCreados = [];
        foreach ($permisos as $p) {
            $permisosCreados[$p['nombre']] = Permiso::firstOrCreate(
                ['nombre' => $p['nombre']],
                $p
            );
        }
 
        // ── Roles ─────────────────────────────────────────────
        $admin = Rol::firstOrCreate(['nombre' => 'Administrador'], ['descripcion' => 'Acceso total al sistema']);
        $operador = Rol::firstOrCreate(['nombre' => 'Operador'], ['descripcion' => 'Gestiona importaciones y documentos']);
        $visor = Rol::firstOrCreate(['nombre' => 'Visor'], ['descripcion' => 'Solo lectura']);
 
        // Administrador: todos los permisos
        $admin->permisos()->sync(array_column($permisosCreados, 'id_permiso'));
 
        // Operador: importaciones, documentos, pagos, catálogos ver
        $operador->permisos()->sync([
            $permisosCreados['importacion.ver']->id_permiso,
            $permisosCreados['importacion.crear']->id_permiso,
            $permisosCreados['importacion.editar']->id_permiso,
            $permisosCreados['documento.subir']->id_permiso,
            $permisosCreados['documento.validar']->id_permiso,
            $permisosCreados['pago.registrar']->id_permiso,
            $permisosCreados['catalogo.ver']->id_permiso,
        ]);
 
        // Visor: solo ver
        $visor->permisos()->sync([
            $permisosCreados['importacion.ver']->id_permiso,
            $permisosCreados['catalogo.ver']->id_permiso,
        ]);
 
        // ── Usuario Administrador ─────────────────────────────
        $usuarioAdmin = Usuario::firstOrCreate(
            ['nombre_usuario' => 'admin'],
            [
                'nombre_completo' => 'Administrador del Sistema',
                'email'           => 'admin@sistema.mx',
                'hash_contrasena' => Hash::make('Admin1234!'),
                'activo'          => true,
            ]
        );
        $usuarioAdmin->roles()->syncWithoutDetaching([$admin->id_rol]);
    }
}
 