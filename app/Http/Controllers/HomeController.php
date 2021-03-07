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
        $anuncios = Anuncio::where('activo', 1)
            ->where('pausado', 0)
            ->with('tipo', 'fotos', 'etiquetas')
            ->get();
        return view('home', compact('anuncios'));
    }
}
