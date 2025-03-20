<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
                'unique:suppliers,name,' . $this->supplier->id
            ],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required'],
            'address' => ['required', 'string', 'max:200',],
            'shopname' => ['required', 'string', 'max:200',],
            'image' => ['image', 'max:3000'],

        ];
    }
}
