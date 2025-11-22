<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateOrderRequest extends FormRequest
{
   public function authorize(): bool
    {
        return true; // no hay auth en la prueba
    }

    public function rules(): array
    {
        return [
            'orderId' => ['required', 'string'],
            'discountCode' => ['nullable', 'string', 'in:PROMO10,FREESHIP,NONE'],
            'items' => ['required', 'array', 'min:1'],

            'items.*.sku' => ['required', 'string'],
            'items.*.price' => ['required', 'numeric', 'gt:0'],
            'items.*.quantity' => ['required', 'integer', 'gt:0'],
        ];
    }
}
