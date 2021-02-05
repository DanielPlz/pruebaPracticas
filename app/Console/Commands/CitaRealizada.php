<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CitaRealizada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'realizada:cita';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se actualiza el estado de las citas realizadas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = new \DateTime();
        $fecha_actual = $now->format('Y-m-d H:i:s');
        $citas = Cita::select('id')
                ->where('estado','Confirmado')
                ->where('fecha',date("Y-m-d",strtotime($fecha_actual)))
                ->where('hora_inicio','<=', date("H:i:s",strtotime($fecha_actual)))
                ->get();
        foreach($citas as $cita){
            Cita::where('id',$cita->id)->update(['estado'=>'Realizado']);
        }
    }
}
