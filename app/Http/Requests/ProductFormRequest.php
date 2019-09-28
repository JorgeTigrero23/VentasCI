<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'stock'=> 'required', 
            'category_id' => 'required|exists:categories,id',
        ];

        switch($method):

            case 'POST':
                $rules += ['barcode' => 'required|unique:products,barcode', 
                            'name' => 'required|unique:products,name'
                          ];
                break;

            case 'PUT':
                 $rules += ['barcode' => 'required|unique:products,barcode,'.$this->get('id'), 
                            'name' => 'required|unique:products,name,'.$this->get('id')
                          ];
                break;

            case 'PATCH':
                $rules += ['barcode' => 'required|unique:products,barcode,'.$this->get('id'), 
                            'name' => 'required|unique:products,name,'.$this->get('id')
                          ];
                break;

            default: break;

        endswitch;
        
        return $rules;
    }

    public function messages()
    {

        return [
            'barcode.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El :attribute es obligatorio.',
            'price.required' => 'El :attribute es obligatorio.',
            'stock.required' => 'El :attribute es obligatorio.',
            'category_id.required' => 'La :attribute es obligatorio.',
            'barcode.unique' => 'El :attribute ya se encuentra registrado.',
            'name.unique' => 'El :attribute ya se encuentra registrado.',
            'category_id.exists' => 'La :attribute no se encuentra registrado.',
        ];

    }

    public function attributes()
    {

        return [
            'barcode' => 'Código de Barra',
            'name' => 'Nombre',
            'price' => 'Precio',
            'stock'=> 'Stock',
            'category_id' => 'Categoría',
        ];

    }

}
