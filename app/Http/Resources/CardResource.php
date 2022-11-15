<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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

            'id'=>$this->id,
            'name'=>$this->name,
            'card_number'=>$this->card_number,
            'expire_month'=>$this->expire_month,
            'expire_year'=>$this->expire_year,
            'cvv'=>$this->CVV,
            'user'=>new UserResource($this->user)
        ];
    }
}
