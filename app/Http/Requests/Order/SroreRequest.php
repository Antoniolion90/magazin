<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class SroreRequest extends FormRequest
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
            'products' => 'required|json',
            'price' => 'required|integer',
            'user_id' => 'required|integer',
            'address' => 'required|string',
            'address_price' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Это поле необходимо для заполнения',
            'products.string' => 'Данные должны соответсвовать строчному типу',
            'price.required' => 'Это поле необходимо для заполнения',
            'price.integer' => 'Цена должны быть числом',
            'user_id.required' => 'Это поле необходимо для заполнения',
            'user_id.integer' => 'Id категории должны быть числом',
            'user_id.exists' => 'Id категории должен быть в базе данных',
        ];

    }
}
