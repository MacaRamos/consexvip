<?php

namespace App\Console\Commands;

use App\Models\Anuncio\Anuncio;
use Illuminate\Console\Command;

class validarTiempoActivoAnuncios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consexvip:tiempos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para validar el tiempo que lleva activo un anuncio según su tipo de anuncio (semanal, quincenal, mensual)';

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
     * @return int
     */
    public function handle()
    {
        $anuncios = Anuncio::where('activo', 1)->with('tipo')->get();
        $desactivados = 0;
        foreach ($anuncios as $key => $anuncio) {
            $fechaActual = new \DateTime('now');
            $fechaActivo = new \DateTime($anuncio->fecha_activo);

            $tiempoActivo = $fechaActivo->diff($fechaActual);
            // dd($tiempoActivo, $tiempoActivo->days);
            switch ($anuncio->tipo->nombre) {
                case 'Semanal':
                    $tiempoPermitido = 7;
                    break;
                case 'Quincenal':
                    $tiempoPermitido = 15;
                    break;
                case 'Mensual':
                    $tiempoPermitido = date('m');              
                    break;
            }
            if($tiempoActivo->days > $tiempoPermitido){
                $anuncio->activo = false;
                $anuncio->fecha_activo = null;
                $anuncio->tiempo_activo = 0;
                $anuncio->save();
                $desactivados++;
            }else{
                $anuncio->tiempo_activo = $tiempoActivo->days;
                $anuncio->save();
            }
        }
        return 'Se han desactivos '.$desactivados.' anuncios';
    }
}
