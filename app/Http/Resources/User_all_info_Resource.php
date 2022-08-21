<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User_all_info_Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[

          'full_name'=>$this->getFullName(),
           'email'=>$this->email,
          'phone'=>$this->phone,
          'email_verified'=>$this->email_verified,
          'phone_verified'=>$this->phone_verified,
          'billing_address'=>new  AddressResource($this->billingAddresses),
          'shipping_address'=>new AddressResource($this->shippingAddresses),
          'created_at'=>$this->created_at->format('d/m/Y'),

        ];
    }
}
