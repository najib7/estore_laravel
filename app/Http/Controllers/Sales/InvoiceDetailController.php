<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sales\SaleDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product'          => 'required|numeric|exists:products,id',
            'quantity'      => 'required|numeric|min:1|max:' . Product::find($request['product'])->quantity,
            'invoiceId'     => 'required|numeric|exists:sales_invoices,id',
            'price' => 'required|numeric|min:0.01|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $product = Product::find($request['product']);
        $product->update([
            'quantity' => $product->quantity - $request['quantity']
        ]);

        SaleDetails::create([
            'product_id' => $product->id,
            'invoice_id' => $request['invoiceId'],
            'quantity'   => $request['quantity'],
            'price'      => $request['price']
        ]);

        return response()->json(['status' => 'success', 'message' => 'detail created']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales\SaleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleDetails $detail)
    {
        $detail->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.msg.deleted')
        ]);
    }
}
