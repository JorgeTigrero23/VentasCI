<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
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
        $id = $this->user;
        $rules = User::$rules;
        $rules['username'] = $rules['username'] . ',username,' . $id;
        unset($rules['password']);

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El campo :attribute es obligatorio.',
            'last_name.unique' => 'El campo :attribute ya se encuentra registrado.',
            'phone.required' => 'El campo :attribute es obligatorio.',
            'username.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El campo :attribute es obligatorio.',
            'email.min' => 'El campo :attribute es obligatorio.',
           // 'image.required' => 'El campo :attribute es obligatorio.',
        ];

    }

    public function attributes()
    {
        return [
            'first_name' => 'Nombres',
            'last_name'=> 'Apellidos',
            'phone'    => 'Teléfono',
            'username' => 'Nombre de Usuario',
            'name'     => 'Cargo',
            'email'    => 'Correo',
            'password' => 'Contraseña',
            'image'    => 'Imagen',
        ];

    }
    
}
