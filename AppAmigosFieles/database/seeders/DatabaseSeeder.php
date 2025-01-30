<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Verificar y crear roles si no existen
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superAdmin', 'guard_name' => 'web']);
        $roleVoluntario = Role::firstOrCreate(['name' => 'voluntario', 'guard_name' => 'web']);

        // Definir permisos si no existen
        $permisosSuperAdmin = [
            'animales',
            'adoptantes',
            'adopciones',
            'gastos',
            'users',
            'seguimientoadopcione',
            'visitasseguimiento',
        ];

        $permisosVoluntario = [
           'animales',
            'adoptantes',
            'gastos',
        ];

        // Crear los permisos necesarios si no existen
        foreach (array_merge($permisosSuperAdmin, $permisosVoluntario) as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // Asignar todos los permisos al rol superAdmin
        $roleSuperAdmin->syncPermissions(Permission::all());

        // Asignar permisos específicos al rol voluntario
        $roleVoluntario->syncPermissions($permisosVoluntario);

        // Verificar y crear el usuario superAdmin si no existe
        $userSuperAdmin = User::firstOrCreate(
            ['email' => 'dayanacarobarriga@gmail.com'],
            [
                'name' => 'Dayana Barriga',
                'password' => bcrypt('superAdmin2025'),
                'estado' => 'activo',
            ]
        );

        // Asignar el rol superAdmin al usuario
        $userSuperAdmin->assignRole('superAdmin');

        
    }
}
