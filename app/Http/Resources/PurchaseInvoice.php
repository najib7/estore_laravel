<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoice extends JsonResource
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
            'supplier' => $this->supplier->name,
            'user'     => $this->user->username,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'note' => $this->note,
            'details' => PurchaseDetails::collection($this->details)
        ];
    }
}
