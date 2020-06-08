<?php

namespace App\Models\Purchases;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $table = 'purchases_invoices';

    protected $fillable = [
        'supplier_id', 'user_id', 'payment_type', 'payment_status', 'note'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetails::class, 'invoice_id');
    }

}
