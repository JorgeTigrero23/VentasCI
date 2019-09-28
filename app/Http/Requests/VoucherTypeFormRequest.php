<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherTypeFormRequest extends FormRequest
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

        $rules = [
            'quantity' => 'required|min:0',
            'igv' => 'required|min:0',
            'serie' => 'required',
        ];

        switch($method):

            case 'POST':
                $rules += [ 'name' => 'required|unique:voucher_types,name'];
                break;

            case 'PUT':
                $rules += ['name' => 'required|unique:voucher_types,name,'.$this->get('id') ];
                break;

            case 'PATCH':
                $rules += ['name' => 'required|unique:voucher_types,name,'.$this->get('id') ];
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
            'quantity.required' => 'La :attribute es obligatorio.',
            'igv.required' => 'El :attribute es obligatorio.',
            'serie.required' => 'La :attribute es obligatorio.',
            'quantity.min' => 'La :attribute no debe ser un valor negativo.',
            'igv.min' => 'El :attribute no debe ser un valor negativo.',
        ];

    }

    public function attributes()
    {

        return [
            'name' => 'Nombre',
            'quantity' => 'Cantidad',
            'igv' => 'Igv',
            'serie' => 'Serie',
        ];

    }

}