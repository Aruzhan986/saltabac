<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShoppingCartRequest extends FormRequest
{
    public function rules()
{
    return [
        'item_id' => 'required|exists:items,item_id',
        'item_quantity' => 'required|integer|min:1'
    ];
}

}
