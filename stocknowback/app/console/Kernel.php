<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Los comandos de consola de la aplicación.
     *
     * @var array
     */
    protected $commands = [
        // Lista de comandos personalizados
    ];

    /**
     * Defina las programación de comandos de la consola.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejemplo: ejecutar un comando todos los días
        $schedule->command('inspire')->hourly();
    }

    /**
     * Registre los comandos para la aplicación.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
