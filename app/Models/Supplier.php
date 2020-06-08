<?php

namespace App\Models;

use App\Models\Purchases\PurchaseInvoice;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['name', 'phone', 'email', 'address'];

    public $timestamps = false;

    public function purchasesInvoices()
    {
        return $this->hasMany(PurchaseInvoice::class);
    }
}
