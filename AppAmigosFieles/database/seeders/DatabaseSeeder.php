<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Verificar si los roles ya existen antes de crearlos
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superAdmin', 'guard_name' => 'web']);
        $roleVoluntario = Role::firstOrCreate(['name' => 'voluntario', 'guard_name' => 'web']);

        // Verificar si los permisos ya existen antes de crearlos
        $permissionManageRoles = Permission::firstOrCreate(['name' => 'manage roles', 'guard_name' => 'web']);
        $permissionViewAnimals = Permission::firstOrCreate(['name' => 'view animals', 'guard_name' => 'web']);
        $permissionManageAnimals = Permission::firstOrCreate(['name' => 'manage animals', 'guard_name' => 'web']);
        $permissionViewAdopcion = Permission::firstOrCreate(['name' => 'view adopcion', 'guard_name' => 'web']);
        $permissionViewSeguimientos = Permission::firstOrCreate(['name' => 'view seguimientos', 'guard_name' => 'web']);
        $permissionViewVisitas = Permission::firstOrCreate(['name' => 'view visitas', 'guard_name' => 'web']);
        $permissionViewUsuarios = Permission::firstOrCreate(['name' => 'view usuarios', 'guard_name' => 'web']);
        // Asignar permisos al rol superAdmin
        $roleSuperAdmin->syncPermissions(Permission::all());
        $roleVoluntario>syncPermissions(Permission::$permissionViewAdopcion);
        $roleVoluntario>syncPermissions(Permission::$permissionViewSeguimientos);
        $roleVoluntario>syncPermissions(Permission::$permissionViewVisitas);
        $roleVoluntario>syncPermissions(Permission::$permissionViewUsuarios);
        // Verificar si el usuario superAdmin ya existe antes de crearlo
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
