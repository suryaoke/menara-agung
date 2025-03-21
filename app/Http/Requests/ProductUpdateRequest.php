<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:200',
                'unique:products,name,' . $this->product->id
            ],
            'supplier_id' => ['required'],
            'category_id' => ['required'],
            'product_code' => ['required'],
            'tanggal_beli' => ['required'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
          
            'image' => ['image', 'max:3000'],
        ];
    }
}
