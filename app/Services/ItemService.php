<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function getAllItems()
    {
        return Item::all();
    }

    public function createItem($data)
    {
        if (isset($data['image'])) {
            $data['image_path'] = $data['image']->store('items', 'public');
        }

        return Item::create($data);
    }

    public function getItemById($id)
    {
        return Item::find($id);
    }

    public function updateItem($data, $id)
    {
        $item = $this->getItemById($id);

        if ($item) {
            if (isset($data['image'])) {
                $data['image_path'] = $data['image']->store('items', 'public');
            }

            $item->update($data);
            return $item;
        }

        return null;
    }

    public function deleteItem($id)
    {
        $item = $this->getItemById($id);
        if ($item) {
            $item->delete();
            return $item;
        }
        return null;
    }
}
