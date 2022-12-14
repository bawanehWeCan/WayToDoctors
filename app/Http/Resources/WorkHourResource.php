<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkHourResource extends JsonResource
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
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at,
            'status'=>$this->status,
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at,
            'doctor_id'=>$this->doctor?->id,
            'clinic_id'=>$this->clinic?->id,

        ];
    }
}
