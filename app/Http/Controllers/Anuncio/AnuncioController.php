<?php

namespace App\Http\Controllers\Anuncio;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionAnuncio;
use App\Models\Anuncio\Anuncio;
use App\Models\Anuncio\Etiqueta;
use App\Models\Anuncio\Foto;
use App\Models\Anuncio\Tipo;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anuncios = Anuncio::get();
        return view('anuncios.index', compact('anuncios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::get();
        return view('anuncios.crear', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionAnuncio $request)
    {
        // dd($request->all());
        $anuncio = new Anuncio();
        $anuncio->usuario_id = Auth::user()->id;
        $anuncio->tipo_id = $request->tipo_id;
        $anuncio->nombre = $request->nombre;
        $anuncio->subtitulo = $request->subtitulo;
        $anuncio->descripcion = $request->descripcion;
        $anuncio->ubicacion = $request->ubicacion;
        $anuncio->telefono = $request->telefono;
        $anuncio->whatsapp = "https://wa.me/" . $request->whatsapp;
        $anuncio->precio_hora = (int)str_replace($request->precio_hora, '$ ', '');
        $anuncio->horario_inicio = $request->horario_inicio;
        $anuncio->horario_fin = $request->horario_fin;
        $anuncio->activo = true;
        $anuncio->fecha_activo = date('Y-m-d H:i:s');
        $anuncio->save();

        if (count((array) $request->fotos) > 0) {
            foreach ((array) $request->fotos as $key => $f) {
                if (isset($f)) {
                    $size = Storage::size(asset('storage/' . $f));
                    $foto = new Foto();
                    $foto->anuncio_id = $anuncio->id;
                    $foto->foto = $f;
                    $foto->size = $size;
                    $foto->save();
                }
            }
        }

        if (count((array) $request->etiquetas) > 0) {
            foreach ((array) $request->etiquetas as $key => $tag) {
                if (isset($tag)) {
                    $etiqueta = new Etiqueta();
                    $etiqueta->anuncio_id = $anuncio->id;
                    $etiqueta->etiqueta = $tag;
                    $etiqueta->save();
                }
            }
        }

        $notificacion = array(
            'mensaje' => 'Anuncio creado con éxito',
            'tipo' => 'success',
            'titulo' => 'Anuncios'
        );
        return redirect('/anuncios')->with($notificacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos = Tipo::get();
        $anuncio = Anuncio::where('id', $id)->with('fotos')->first();
        return view('anuncios.editar', compact('anuncio', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionAnuncio $request, $id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->tipo_id = $request->tipo_id;
        $anuncio->nombre = $request->nombre;
        $anuncio->subtitulo = $request->subtitulo;
        $anuncio->descripcion = $request->descripcion;
        $anuncio->ubicacion = $request->ubicacion;
        $anuncio->telefono = $request->telefono;
        $anuncio->whatsapp = "https://wa.me/" . $request->whatsapp;
        $anuncio->precio_hora = (int)str_replace($request->precio_hora, '$ ', '');
        $anuncio->horario_inicio = $request->horario_inicio;
        $anuncio->horario_fin = $request->horario_fin;
        $anuncio->activo = true;
        $anuncio->fecha_activo = date('Y-m-d H:i:s');
        $anuncio->save();

        Foto::where('anuncio_id', $id)->delete();
        if (count((array) $request->fotos) > 0) {
            foreach ((array) $request->fotos as $key => $f) {
                if (isset($f)) {
                    $size = Storage::size('public/' . $f);
                    $foto = new Foto();
                    $foto->anuncio_id = $anuncio->id;
                    $foto->foto = $f;
                    $foto->size = $size;
                    $foto->save();
                }
            }
        }

        Etiqueta::where('anuncio_id', $id)->delete();
        $etiquetas = explode(',', (string)$request->etiquetas);
        if (count((array) $request->etiquetas) > 0) {
            foreach ($etiquetas as $tag) {
                if (isset($tag)) {
                    $etiqueta = new Etiqueta();
                    $etiqueta->anuncio_id = $anuncio->id;
                    $etiqueta->etiqueta = $tag;
                    $etiqueta->save();
                }
            }
        }

        $notificacion = array(
            'mensaje' => 'Anuncio actualizado con éxito',
            'tipo' => 'success',
            'titulo' => 'Anuncios'
        );
        return redirect('/anuncios')->with($notificacion);
    }

    public function subirFotos(Request $request)
    {
        $parametro = Parametro::where('nombre', 'Fotos')->first();
        if ($parametro && $parametro->indice >= 0) {
            $nombreArchivo = 'File-' . $parametro->indice . '.' . $request->file('file')->extension();
            $parametro->indice += 1;
            $parametro->save();
        } else {
            $nombreArchivo = 'File-1.' . $request->file('file')->extension();
            $parametro = new Parametro;
            $parametro->nombre = 'Fotos';
            $parametro->indice = 1;
            $parametro->save();
        }
        Storage::disk('public')->put($nombreArchivo,  file_get_contents($request->file('file')));
        return response()->json(['value' => $nombreArchivo, 'size' => $request->file('file')->getSize()]);
    }

    public function eliminarFoto(Request $request, $anuncio = null)
    {
        unlink(storage_path('app/public/' . $request->name));
        if ($anuncio) {
            $anuncio = Foto::where('anuncio_id', $anuncio)
                ->where('foto', '=', $request->name)
                ->delete();
        }
        return response()->json('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Foto::where('anuncio_id', $id)->delete();
        Etiqueta::where('anuncio_id', $id)->delete();
        $anuncio = Anuncio::find($id);
        if ($request->ajax()) {
            if ($anuncio->delete()) {
                return response()->json(['mensaje' => 'El anuncio fue eliminado correctamente', 'tipo' => 'success']);
            } else {
                return response()->json(['mensaje' => 'El anuncio no pudo ser eliminado, hay recursos usándolo', 'tipo' => 'error']);
            }
        } else {
            abort(404);
        }
    }
}
