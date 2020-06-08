<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Purchases\PurchaseDetails;
use App\Models\Sales\SaleDetails;

trait Statistics
{
    public function products()
    {
        $products = Product::all();

        $total = $products->count();
        $out = $products->filter(function ($item) {
            return $item['quantity'] === 0;
        })->count();
        $quantityStock = $products->map(function ($item) {
            return $item['quantity'];
        })->sum();


        return [
            'total' => $total,

            'av' => $total - $out,

            'outOfStock' => $out,

            'quantityStock' => $quantityStock
        ];
    }

    public function purchases()
    {
        $purchases_details = PurchaseDetails::all();

        $purchases_quantity = $purchases_details->map(function ($item) {
            return $item['quantity'];
        })->sum();

        $purchases_price = $purchases_details->map(function ($item) {
            return $item['quantity'] * $item['price'];
        })->sum();

        return [
            'count' => $purchases_details->count(),
            'quantity' => $purchases_quantity,
            'total_price' => $purchases_price
        ];
    }

    public function sales()
    {
        $sales_details = SaleDetails::all();

        // sales
        $sales_quantity = $sales_details->map(function ($item) {
            return $item['quantity'];
        })->sum();

        $sales_price = $sales_details->map(function ($item) {
            return $item['quantity'] * $item['price'];
        })->sum();

        return [
            'count' => $sales_details->count(),
            'quantity' => $sales_quantity,
            'total_price' => $sales_price
        ];
    }
}
