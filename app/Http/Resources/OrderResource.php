<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'status' => $this->status,
            'order_date' => $this->order_date,
            'payment_due' => $this->payment_due,
            'payment_status' => $this->payment_status,
            // 'payment_token' => $this->payment_token,
            // 'payment_url' => $this->payment_url,
            'base_total_price' => $this->base_total_price,
            // 'tax_amount' => $this->tax_amount,
            // 'tax_percent' => $this->tax_percent,
            // 'discount_amount' => $this->discount_amount,
            'product' => $this->orderItems->map(function ($item) {
                    return [
                        'qty' => $item->qty,
                        'name' => $item->name,
                    ];
                }),
            'discount_percent' => $this->discount_percent,
            'shipping_cost' => $this->shipping_cost,
            'grand_total' => $this->grand_total,
            'customer_first_name' => $this->customer_first_name,
            'customer_last_name' => $this->customer_last_name,
            'customer_address1' => $this->customer_address1,
            'customer_address2' => $this->customer_address2,
            'customer_phone' => $this->customer_phone,
            'customer_email' => $this->customer_email,
            'warehouse_name' => $this->warehouse->name,
            'customer_city_id' => $this->customer_city_id,
            'city' => [
                'city_id' => $this->city->city_id,
                'province_id' => $this->city->province_id,
                'type' => $this->city->type,
                'city_name' => $this->city->city_name,
                ],
            'customer_province_id' => $this->customer_province_id,
            'province' => [
                'province_id' => $this->province->province_id,
                'province_name' => $this->province->province_name,
                ],
            'customer_kecamatan_id' => $this->customer_kecamatan_id,
            'kecamatan' => [
                'id' => $this->kecamatan->id,
                'name' => $this->kecamatan->name,
                'city_id' => $this->kecamatan->city_id
                ],
            'customer_postcode' => $this->customer_postcode,
            'shipping_courier' => $this->shipping_courier,
            'shipping_service_name' => $this->shipping_service_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
