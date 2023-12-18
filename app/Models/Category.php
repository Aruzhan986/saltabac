<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_categories';

    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name'];
    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany(Item::class, 'product_category_id');
    }
}

