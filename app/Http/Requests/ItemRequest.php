<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'item_name' => 'required|string|max:100',
            'stock_quantity' => 'required|integer',
            'unit_price' => 'required|numeric',
            'image' => 'sometimes|file|image|max:2048',
            'product_category_id' => 'required|exists:product_categories,category_id',
        ];
    }
}

