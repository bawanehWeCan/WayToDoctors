<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'second_name'   => $this->profile->second_name??NULL,
            'third_name'    => $this->profile->third_name??NULL,
            'last_name'     => $this->profile->last_name??NULL,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'nationality'   => $this->profile->nationality??NULL,
            'country'       => $this->profile->country??NULL,
            'city'          => $this->profile->city??NULL,
            'national_id'   => $this->profile->national_id??NULL,
            'date_of_birth' => $this->profile->date_of_birth??NULL,
            'gender'        => $this->profile->gender??NULL,
            'status'        => $this->profile->status??NULL,
            'image'        => (string)$this->image??null,

        ];
    }
}
