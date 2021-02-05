<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
   
        //se describe la ruta de nuestro comando
    protected $commands = [
        'App\Console\Commands\MensajeCommand',
        "App\Console\Commands\Smscommand",
        "App\Console\Commands\Smscommand12",
        "App\Console\Commands\Smscommand24",
        'App\Console\Commands\MensajeCommand24',
        'App\Console\Commands\MensajeCommand6',
        'App\Console\Commands\MensajeCommand48',
        'App\Console\Commands\CitaRealizada',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    { 
        //comando de las citas realizadas
        $schedule->command('realizada:cita')->weekdays()->everyFifteenMinutes()->between('09:00', '19:00');
        
        //Comandos envío de SMS
        $schedule->command('sms:users')->weekdays()->hourly()->between('3:00', '13:00');
        $schedule->command('sms12:users')->weekdays()->hourly()->between('3:00', '13:00');
        $schedule->command('sms24:users')->dailyAt('11:00');

        //Comandos envío de Whatsapp
        $schedule->command('mensaje6:users')->weekdays()->hourly()->between('3:00', '13:00');
        $schedule->command('mensajes:users')->hourly()->between('20:00', '05:00');
        $schedule->command('mensajes24:users')->hourly()->between('09:00', '19:00');
        $schedule->command('mensajes48:users')->hourly()->between('09:00', '19:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}