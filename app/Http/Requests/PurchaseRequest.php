<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => 'required|exists:items,item_id',
            'customer_id' => 'required|exists:customers,customer_id',
            'purchase_date' => 'required|date',
        ];
    }
}
