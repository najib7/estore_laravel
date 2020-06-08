<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'products_categories';

    protected $primaryKey = 'id';

    public $timestamps = false;


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
