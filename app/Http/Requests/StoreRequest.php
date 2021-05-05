<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'phone' => 'required|min:10',
            'mobile_phone' => 'required',
            'logo' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'Este campo deve ter no mínimo :min caracteres.',
            'image' => 'O arquivo enviado não é uma imagem válida.'
        ];
    }
}