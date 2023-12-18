<?php

namespace App\Services;

use App\Models\Purchase;

class PurchaseService
{
    public function retrieveAll()
    {
        return Purchase::with(['item', 'customer'])->whereNull('deleted_at')->get();
    }

    public function find($id)
    {
        return Purchase::with(['item', 'customer'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Purchase::create($data);
    }

    public function modify(array $data, $id)
    {
        $purchase = $this->find($id);
        return $purchase ? tap($purchase)->update($data) : null;
    }

    public function remove($id)
    {
        $purchase = $this->find($id);
        return $purchase ? tap($purchase)->delete() : null;
    }
}
