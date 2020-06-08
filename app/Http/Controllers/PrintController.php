<?php

namespace App\Http\Controllers;

use App\Models\Purchases\PurchaseInvoice;
use App\Models\Sales\SaleInvoice;
use Barryvdh\DomPDF\Facade as PDF;

class PrintController extends Controller
{
    public function sale($id)
    {
        $invoice = SaleInvoice::findOrFail($id);
        $pdf = PDF::loadView('print.sale', compact('invoice'));

        return $pdf->download('sale_invoice_'. $invoice->id .'.pdf');

        // return view('print.sale', compact('invoice'));
    }

    public function purchase($id)
    {
        $invoice = PurchaseInvoice::findOrFail($id);
        $pdf = PDF::loadView('print.purchase', compact('invoice'));

        return $pdf->download('purchase_invoice_'. $invoice->id .'.pdf');

        // return view('print.sale', compact('invoice'));
    }
}
