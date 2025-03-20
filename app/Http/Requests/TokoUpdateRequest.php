<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokoUpdateRequest extends FormRequest
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
            ],
            'no_handphone' => ['required'],
            'address' => ['required', 'string', 'max:200',],
            'image' => ['image', 'max:3000'],
        ];
    }
}
