<?php

namespace App\Http\Controllers;

use App\Models\Anuncio\Anuncio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $anuncios = Anuncio::where('activo', 1)->with('tipo')->get();
        foreach ($anuncios as $key => $anuncio) {
            $fechaActual = new \DateTime('now');
            $tiempoActivo = new \DateTime($anuncio->fecha_activo);
            switch ($anuncio->tipo->nombre) {
                case 'Semanal':
                    $tiempoActivo->modify('+7 Days'); 
                    break;
                case 'Quincenal':
                    $tiempoActivo->modify('+15 Days');  
                    break;
                case 'Mensual':
                    if($fechaActual->format('m') == 02){
                        $tiempoActivo->modify('+28 Days'); 
                    }else{
                        $tiempoActivo->modify('+31 Days'); 
                    }                     
                    break;
            }
            if($fechaActual > $tiempoActivo){
                $anuncio->activo = false;
                $anuncio->fecha_activo = null;
                $anuncio->save();
            } 
        }
        $anuncios = Anuncio::where('activo', 1)->with('tipo', 'fotos', 'etiquetas')->get();
        return view('home', compact('anuncios'));
    }
}