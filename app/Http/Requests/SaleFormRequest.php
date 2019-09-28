<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleFormRequest extends FormRequest
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
            'date' => 'required',
            'subtotal' => 'required',
            'igv' => 'required',
           // 'discount' => 'required',
            'total' => 'required',
            'voucher_type_id' => 'required',
            'client_id' => 'required',
            'voucher_number' => 'required',
            'serie' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|min:1',
        ];
    }

    public function messages()
    {

        return [
            'date.required' =>  'El campo :attribute es obligatorio.',
            'subtotal.required' => 'El campo :attribute es obligatorio.',
            'igv.required' => 'El campo :attribute es obligatorio.',
        //    'discount.required' => 'El campo :attribute es obligatorio.',
            'total.required' => 'El campo :attribute es obligatorio.',
            'voucher_type_id.required' => 'El campo :attribute es obligatorio.',
            'client_id.required' => 'El campo :attribute es obligatorio.',
            'voucher_number.required' => 'El campo :attribute es obligatorio.',
            'serie.required' => 'El campo :attribute es obligatorio.',
            'product_id.required' => 'Por favor al menos debe tener un producto en el detalle de factura,',
            'quantity.required' => 'Por favor el producto seleccionado debe tener como minimo 1 cantidad.',
            'quantity.min' => 'Por favor el producto seleccionado debe tener como minimo 1 cantidad.',
        ];

    }

    public function attributes()
    {

        return [
            'date' => 'Fecha',
            'subtotal' => 'Subtotal',
            'igv' => 'Iva',
           // 'discount' => 'Descuento',
            'total' => 'Total',
            'voucher_type_id' => 'Tipo de Comprobante',
            'client_id' => 'Cliente',
            'voucher_number' => 'Numero de Comprobante',
            'serie' => 'Serie',
            'product_id' => 'Producto',
            'quantity' => 'Cantidad',
        ];

    }
}
