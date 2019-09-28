<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
            'name' => 'required|min:5|max:191',
            'nature' => 'required|min:5|max:30',
            'phone' => 'required|min:5|max:18',
            'fax' => 'required|min:5|max:18',
            'country' => 'required|min:1|max:25',
            'city' => 'required|min:1|max:30',
            'address' => 'required|min:5|max:191',
            'image' => 'mimes:jpg,jpeg,png,bmp',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'El campo :attribute es obligatorio.',
            'nature.required' => 'El campo :attribute es obligatorio.',
            'phone.required' => 'El campo :attribute es obligatorio.',
            'fax.required' => 'El campo :attribute es obligatorio.',
            'country.required' => 'El campo :attribute es obligatorio.',
            'city.required' => 'El campo :attribute es obligatorio.',
            'address.required' => 'El campo :attribute es obligatorio.',

            'name.min' => 'El campo :attribute debe tener al menos 5 caracteres.',
            'nature.min' => 'El campo :attribute debe tener al menos 5 caracteres.',
            'phone.min' => 'El campo :attribute debe tener al menos 5 caracteres.',
            'fax.min' => 'El campo :attribute debe tener al menos 5 caracteres.',
            'country.min' => 'El campo :attribute debe tener al menos 1 caracteres.',
            'city.min' => 'El campo :attribute debe tener al menos 1 caracteres.',
            'address.min' => 'El campo :attribute debe tener al menos 5 caracteres.',

            'name.max' => 'El campo :attribute debe tener como maximo 191 carateres.',
            'nature.max' => 'El campo :attribute debe tener como maximo 30 carateres.',
            'phone.max' => 'El campo :attribute debe tener como maximo 18 carateres.',
            'fax.max' => 'El campo :attribute debe tener como maximo 18 carateres.',
            'country.max' => 'El campo :attribute debe tener como maximo 25 carateres.',
            'city.max' => 'El campo :attribute debe tener como maximo 30 carateres.',
            'address.max' => 'El campo :attribute debe tener como maximo 191 carateres.',

        ];

    }

    public function attributes()
    {

        return [
            'name' => 'Nombre',
            'nature' => 'Naturaleza',
            'phone' => 'Teléfono',
            'fax' => 'Fax',
            'country' => 'País',
            'city' => 'Ciudad',
            'address' => 'Dirección',
            'image' => 'Imagen',
        ];

    } 
}
