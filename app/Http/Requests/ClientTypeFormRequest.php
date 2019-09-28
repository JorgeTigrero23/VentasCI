<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientTypeFormRequest extends FormRequest
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
        $method = request()->method();

        $rules = [];

        switch($method):

            case 'POST':
                $rules += ['name' => 'required|string|min:2|unique:client_types,name'];
                break;

            case 'PUT':
                $rules += ['name' => 'required|string|min:2|unique:client_types,name,'.$this->get('id')];
                break;

            case 'PATCH':
                $rules += ['name' => 'required|string|min:2|unique:client_types,name,'.$this->get('id')];
                break;

            default: break;

        endswitch;
        
        return $rules;
    }

    public function messages()
    {

        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'El :attribute ya se encuentra registrado.',
            'name.min' => 'El :attribute debe contener mas de 2 caracteres.',
        ];

    }

    public function attributes()
    {

        return [
            'name' => 'Nombre',
        ];

    }
}
