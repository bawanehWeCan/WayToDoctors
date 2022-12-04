<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'time'=>$this->time,
            'date'=>$this->date,
            'status'=>$this->status,
            'type'=>$this->type,
            'booking_type'=>$this->booking_type,
            'location'=>(string)$this->location,
            'case_description'=>(string)$this->case_description,
            'file_path'=>$this->file_path,
            // 'doctor_name'=>$this->doctor->name,
            'doctor'=>new DoctorResource($this?->doctor),
            // 'user'=>new UserResource($this->user),
            'user_id'=>$this->user_id,

        ];
    }
}
