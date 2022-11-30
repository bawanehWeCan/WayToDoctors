<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdentityResource extends JsonResource
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

            'image_front'=>$this->image_front,
            'image_back'=>$this->image_back,
            'status'=>$this->status,
            // 'user'=>new UserResource($this->user),
            'user_id'=>$this->user_id,
        ];
    }
}
