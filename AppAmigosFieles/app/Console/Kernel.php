<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Lista de comandos registrados.
     */
    protected $commands = [
        \App\Console\Commands\VerPermisosVoluntario::class, // 👈 Agrega tu comando aquí
    ];

    /**
     * Define el cronograma de comandos de la aplicación.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Registra los comandos de la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
