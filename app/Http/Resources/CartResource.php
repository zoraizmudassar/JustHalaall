<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "user" => new UserResource($this->user),
            "restaurant_id" => $this->restaurant_id,
            "restaurant" => new UserResource($this->restaurant),
            "product_id" => $this->product_id,
            "product" => new UserResource($this->product),
            "unit_price" => $this->unit_price,
            "quantity" => $this->quantity,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
