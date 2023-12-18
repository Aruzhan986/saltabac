<?php

namespace App\Services;

use App\Models\Category;

class CategoryManagementService
{
    public function retrieveAll()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function modify(array $data, $id)
    {
        $category = $this->find($id);
        return $category ? tap($category)->update($data) : null;
    }

    public function remove($id)
    {
        $category = $this->find($id);
        return $category ? tap($category)->delete() : null;
    }

    public function getTrashed()
    {
        return Category::onlyTrashed()->get();
    }

    public function recover($id)
    {
        $category = Category::withTrashed()->find($id);
        return $category ? tap($category)->restore() : null;
    }

    public function forceRemove($id)
    {
        $category = Category::withTrashed()->find($id);
        return $category ? tap($category)->forceDelete() : null;
    }
}
