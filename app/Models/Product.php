<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    public static function searchKeyword()
    {
        return self::select('id', 'name', 'sku', 'price', 'quantity', 'created_at')->paginate(10);
    }
}
