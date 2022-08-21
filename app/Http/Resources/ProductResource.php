<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
               'product_id'=>$this->product_id,
               'product_name'=>$this->name,
               'product_discription'=>$this->description,
               'product_price'=>$this->price,
               'product_qnty'=>$this->available,
               'product_discount'=>$this->discount,
               'unit'=>new UnitResource($this->units),
               'categories'=>new CategoryResource($this->categories),
               'tags'=>TagResource::collection($this->tags),
               'images'=>ImageResource::collection($this->images),
               'reviews'=>ReviewResource::collection($this->reviews),
               'options'=>OptionResource::collection($this->optionlists),

        ];
    }
}
