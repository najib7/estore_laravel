<?php

namespace App\Models\Sales;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $table = 'sales_details';

    // public $timestamps = false;

    protected $fillable = [
        'product_id', 'invoice_id', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function invoice()
    {
        return $this->belongsTo(SaleInvoice::class, 'invoice_id');
    }


}
