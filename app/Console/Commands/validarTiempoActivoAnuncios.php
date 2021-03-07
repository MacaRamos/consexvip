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
            if ($anuncio->pausado) {
                $fechaPausado = new \DateTime($anuncio->fecha_pausado);
                $tiempoPausado = $fechaActual->diff($fechaPausado);
                if ($tiempoPausado->days > $tiempoPermitido) {
                    $desactivados++;
                    $anuncio->activo = false;
                    $anuncio->fecha_activo = null;
                }    
            } else {
                $fechaActivo = new \DateTime($anuncio->fecha_activo);
                $tiempoActivo = $fechaActual->diff($fechaActivo);
                if ($tiempoActivo->days > $tiempoPermitido) {
                    $desactivados++;
                    $anuncio->activo = false;
                    $anuncio->fecha_activo = null;
                }                
            }
            $anuncio->save();
        }
        return 'Se han desactivos ' . $desactivados . ' anuncios';
    }
}
