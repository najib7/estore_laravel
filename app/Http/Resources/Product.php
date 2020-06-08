<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'image'    => $this->image,
            'quantity' => $this->quantity,
            'price'    => $this->price,
            'category_id' => $this->category->id,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name
            ],
            'sales_count' => $this->salesDetails()->count()
        ];
    }
}
