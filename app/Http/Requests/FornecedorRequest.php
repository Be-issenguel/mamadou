<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
            'nome' => 'required',
            'nif' => 'required|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/i',
            'genero' => 'required',
            'telefone' => 'required|regex:/^[9]{1}[1-9]{1}[0-9]{7}$/i',
        ];
    }
}
