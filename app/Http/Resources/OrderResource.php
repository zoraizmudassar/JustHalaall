<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $delivery_charges = (double)$this->totalDeliveryCharges();
        $total_amount = (double)$this->totalAmount();
        $total = $total_amount + $delivery_charges;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'order_total' => $total_amount,
            'deliveryCharges' => $delivery_charges,
            'total' => $total,
            'payment_type' => $this->payment_type,
            'order_status' => $this->status->status,
            'carts' => CartResource::collection($this->cartsInfo()),
        ];
    }
}
