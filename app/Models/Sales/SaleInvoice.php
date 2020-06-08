<?php

namespace App\Models\Sales;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    protected $table = 'sales_invoices';

    protected $fillable = [
        'client_id', 'user_id', 'payment_type', 'payment_status', 'note', 'discount'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(SaleDetails::class, 'invoice_id');
    }
}
