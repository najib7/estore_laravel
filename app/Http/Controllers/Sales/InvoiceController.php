<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sales\SaleInvoice as SaleInvoiceResource;
use App\Models\Sales\SaleInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        return SaleInvoiceResource::collection(SaleInvoice::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client' => 'required|numeric|exists:suppliers,id',
            'paymentType'   => 'required|' . Rule::in(config('site.payment_type')),
            'paymentStatus' => 'required|' . Rule::in(config('site.payment_status')),
            'note'          => 'string|max:255',
            'discount'      => 'required|numeric|between:0,99.99'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }


        $invoice = SaleInvoice::create([
            'client_id'      => $request['client'],
            'user_id'        => Auth::id(),
            'payment_type'   => $request['paymentType'],
            'payment_status' => $request['paymentStatus'],
            'note'           => $request['note'],
            'discount'       => $request['discount'] / 100
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'saved',
            'data' => new SaleInvoiceResource($invoice)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SaleInvoice $sale)
    {
        return new SaleInvoiceResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales\SaleInvoice  $saleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleInvoice $sale)
    {
        $sale->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.purchases.invoice_deleted', ['id' => $sale->id])
        ]);
    }
}
