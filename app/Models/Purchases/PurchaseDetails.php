<?php

namespace App\Models\Purchases;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table = 'purchases_details';

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
        return $this->belongsTo(PurchaseInvoice::class, 'invoice_id');
    }

}
