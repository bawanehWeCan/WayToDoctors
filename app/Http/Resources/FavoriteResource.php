<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            // 'user'=>$this?->user?->id,
            // 'doctor'=>$this?->doctor?->id,
            'user'=>new UserResource($this->user),
            'doctor'=>new DoctorResource($this->doctor)
        ]

        ;
    }
}
