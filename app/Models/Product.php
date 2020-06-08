<?php

namespace App\Models;

use App\Models\Purchases\PurchaseDetails;
use App\Models\Purchases\PurchaseInvoice;
use App\Models\Sales\SaleDetails;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    protected $fillable = [
        'name', 'image', 'price', 'quantity', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function purchaseDetail()
    {
        return $this->hasOne(PurchaseDetails::class);
    }

    public function salesDetails()
    {
        return $this->hasMany(SaleDetails::class);
    }
}
