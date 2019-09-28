<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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

        $rules =  [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'client_type_id' => 'required|exists:client_types,id',
            'document_type_id'=> 'required|exists:document_types,id',
            'document_number' => 'required',
            'phone' => 'required|string',
        ];

        switch($method):

            case 'POST':
                $rules += ['mail' => 'required|email|unique:clients,mail'];
                break;

            case 'PUT':
                $rules += ['mail' => 'required|email|unique:clients,mail,'.$this->get('id')];
                break;

            case 'PATCH':
                $rules += ['mail' => 'required|email|unique:clients,mail,'.$this->get('id')];
                break;

            default: break;

        endswitch;
        
        return $rules;
    }

    public function messages()
    {

        return [
            'first_name.required' => 'El :attribute es obligatorio.',
            'last_name.required' => 'El :attribute es obligatorio.',
            'client_type_id.required' => 'El :attribute es obligatorio.',
            'document_type_id.required' => 'El :attribute es obligatorio.',
            'document_number.required' => 'El :attribute es obligatorio.',
            'phone.required' => 'El :attribute es obligatorio.',
            'mail.required' => 'El :attribute es obligatorio.',
            'mail.unique' => 'El :attribute ya se encuentra registrado.',
            'client_type_id.exists' => 'El :attribute no se encuentra registrado.',
            'document_type_id.exists' => 'El :attribute no se encuentra registrado.',
        ];

    }

    public function attributes()
    {

        return [
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'client_type_id' => 'Tipo de Cliente',
            'document_type_id'=> 'Tipo de Documento',
            'document_number' => 'Número de Documento',
            'phone' => 'Teléfono',
            'email' => 'Correo',
        ];

    }

}