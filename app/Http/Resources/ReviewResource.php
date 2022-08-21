<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\UserResource;

class ReviewResource extends JsonResource
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
          'review_id'=>$this->rev_id,
          'reviewer'=>new UserResource($this->users),
          'stars'=>$this->stars,
          'text'=>$this->text,

        ];
    }
}
