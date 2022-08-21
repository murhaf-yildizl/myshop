<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           'country'=>$this->country,
           'state'=>$this->state,
           'city'=>$this->city,
           'street_name'=>$this->street_name,
           'bildding_no'=>$this->belding_no,
           'post_code'=>$this->post_code
        ];
    }
}
