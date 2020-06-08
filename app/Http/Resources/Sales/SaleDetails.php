<?php

namespace App\Http\Resources\Sales;

use App\Http\Resources\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => new Product($this->product),
            'quantity' => $this->quantity,
            'price' => $this->price
        ];
    }
}
