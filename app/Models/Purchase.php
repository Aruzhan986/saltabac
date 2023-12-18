<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Purchase extends Model
{
    use HasFactory, SoftDeletes; 

    protected $primaryKey = 'purchase_id';
    protected $fillable = ['item_id', 'customer_id', 'purchase_date'];
    protected $dates = ['deleted_at', 'purchase_date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
