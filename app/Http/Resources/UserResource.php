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
            'second_name'   => (string)$this?->profile?->second_name??null,
            'third_name'    => (string)$this?->profile?->third_name??null,
            'last_name'     => (string)$this?->profile?->last_name??null,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'nationality'   => (string)$this?->profile?->nationality??null,
            'country'       => (string)$this?->profile?->country??null,
            'city'          => (string)$this?->profile?->city??null,
            'national_id'   => (string)$this?->profile?->national_id??null,
            'date_of_birth' => (string)$this?->profile?->date_of_birth??null,
            'gender'        => (string)$this?->profile?->gender??null,
            'status'        => (string)$this?->profile?->status??null,
            'image'        => (string)$this->image?->image


        ];
    }
}
