<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOutRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'required|exists:orders,id',
            'inventory_id' => 'required|exists:inventories,id',
            'tanggal_keluar' => 'required',
            'jumlah_keluar' => 'required'
        ];
    }
}
