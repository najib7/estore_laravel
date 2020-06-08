<?php

namespace App\Http\Controllers\Purchases;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Purchases\PurchaseDetails;
use Illuminate\Support\Facades\Validator;

class PurchaseInvoiceDetailController extends Controller
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
            'name'          => 'required|string',
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'quantity'      => 'required|numeric|min:1|max:100000',
            'purchasePrice' => 'required|numeric|min:0.01|max:100000',
            'salePrice'     => 'required|numeric|min:0.01|max:100000',
            'category'      => 'required|numeric|exists:products_categories,id',
            'invoiceId'     => 'required|numeric|exists:purchases_invoices,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $product = Product::create([
            'name'        => $request['name'],
            'image'       => upload_image($request['image'], $request['name'], 'products'),
            'quantity'    => $request['quantity'],
            'price'       => $request['salePrice'],
            'category_id' => $request['category']
        ]);

        PurchaseDetails::create([
            'product_id' => $product->id,
            'invoice_id' => $request['invoiceId'],
            'quantity'   => $request['quantity'],
            'price'      => $request['purchasePrice']
        ]);

        return response()->json(['status' => 'success', 'message' => 'detail created']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases\PurchaseDetails  $purchaseDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PurchaseDetails::find($id);
        $item->delete();
        return response()->json([
            'status' => 'success',
            'message' => trans('app.msg.deleted')
        ]);
    }
}
