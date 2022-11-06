<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'image'=>$this->image,
            'address'=>$this->address,
            'category_id'=>1,
            'category_name'=>'test',
            'user_count'=>500,
            'rating'=>4.5,
            'experience'=>$this->experience,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'lat'=>$this->lat,
            'long'=>$this->long,
            // 'clinic_id'=>$this->clinic_id,
            'clinic'=>new ClinicResource($this->clinic),

        ];
    }
}
