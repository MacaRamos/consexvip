<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAnuncio extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_id' => 'required|integer|exists:tipos,id',
            'nombre' => 'required|string|max:100',
            'subtitulo' => 'nullable|string|max:100',
            'descripcion' => 'required|string|max:5000',
            'ubicacion' => 'required|string|max:250',
            'telefono' =>  'required|string|min:15',
            'whatsapp' =>  'nullable|string|min:15',
            'precio_hora' =>  'nullable|string|max:11',
            // 'horario_inicio' => 'required_with:horario_fin|date_format:H:i',
            // 'horario_fin' => 'required_with:horario_inicio|date_format:H:i'
        ];
    }
}
