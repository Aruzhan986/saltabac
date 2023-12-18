<?php
namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function retrieveAll()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::find($id);
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }

    public function modify(array $data, $id)
    {
        $customer = $this->find($id);
        return $customer ? tap($customer)->update($data) : null;
    }

    public function remove($id)
    {
        $customer = $this->find($id);
        return $customer ? tap($customer)->delete() : null;
    }

    public function recover($id)
    {
        $customer = Customer::withTrashed()->find($id);
        return $customer ? tap($customer)->restore() : null;
    }
}
