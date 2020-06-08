<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleInvoice extends JsonResource
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
            'client' => $this->client->name,
            'user'     => $this->user->username,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'discount' => $this->discount,
            'note' => $this->note,
            'details' => SaleDetails::collection($this->details)
        ];
    }
}
