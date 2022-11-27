<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RelativeResource extends JsonResource
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

            'full_name'=>$this->full_name,
            'relation'=>$this->relation,
            'phone_number'=>$this->phone_number,
            'address'=>(string)$this->address,
            'career'=>(string)$this->career,
            'user'=>new UserResource($this->user),

        ];
    }
}
