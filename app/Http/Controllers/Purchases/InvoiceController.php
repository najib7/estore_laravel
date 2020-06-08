<?php

namespace App\Http\Controllers\Purchases;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchases\PurchaseInvoice;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PurchaseInvoice as ResourcesPurchaseInvoice;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('show', PurchaseInvoice::class);
        return ResourcesPurchaseInvoice::collection(PurchaseInvoice::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', PurchaseInvoice::class);
        $validator = Validator::make($request->all(), [
            'supplier'      => 'required|numeric|exists:suppliers,id',
            'paymentType'   => 'required|' . Rule::in(config('site.payment_type')),
            'paymentStatus' => 'required|' . Rule::in(config('site.payment_status')),
            'note'          => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $invoice = PurchaseInvoice::create([
            'supplier_id'    => $request['supplier'],
            'user_id'        => Auth::id(),
            'payment_type'   => $request['paymentType'],
            'payment_status' => $request['paymentStatus'],
            'note'           => $request['note']
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'invoice created',
            'data'    => new ResourcesPurchaseInvoice($invoice)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseInvoice $invoice)
    {
        $this->authorize('show', PurchaseInvoice::class);
        return new ResourcesPurchaseInvoice($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases\PurchaseInvoice  $purchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseInvoice $invoice)
    {
        $this->authorize('delete', PurchaseInvoice::class);
        $invoice->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.purchases.invoice_deleted', ['id' => $invoice->id])
        ]);
    }
}
