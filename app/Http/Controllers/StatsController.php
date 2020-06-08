<?php

namespace App\Http\Controllers;

use App\Models\Purchases\PurchaseDetails;
use App\Models\Sales\SaleDetails;
use Carbon\Carbon;

class StatsController extends Controller
{
    private function getLastItems($data) {
        $collect = collect();
        $p = collect();

        for ($i=6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $fetch = $data::whereDate('created_at', $date);

            $count = $fetch->count();
            $profits = $fetch->get()->map(function($item) {
                return $item['quantity'] * $item['price'];
            })->sum();

            $collect->put($date->format('Y-m-d'), $count);
            $p->put($date->format('Y-m-d'), $profits);
        }
        return [
            'count' => $collect->toArray(),
            'profits' => $p->toArray()
        ];
    }

    public function chart()
    {
        $purchases = new PurchaseDetails();
        $sales = new SaleDetails();

        return response()->json([
            'purchases' => $this->getLastItems($purchases),
            'sales' => $this->getLastItems($sales)
        ]);
    }
}
