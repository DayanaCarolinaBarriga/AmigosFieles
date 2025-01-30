<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class VerPermisosVoluntario extends Command
{
    protected $signature = 'ver:permisos-voluntario'; // 👈 Nombre del comando

    protected $description = 'Muestra los permisos asignados al rol voluntario';

    public function handle()
    {
        $role = Role::where('name', 'voluntario')->first();

        if (!$role) {
            $this->error('El rol voluntario no existe.');
            return;
        }

        $permisos = $role->permissions->pluck('name');

        $this->info("Permisos del rol voluntario:");
        foreach ($permisos as $permiso) {
            $this->line("- $permiso");
        }
    }
}
