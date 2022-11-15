<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
<<<<<<< HEAD
        return parent::toArray($request);
=======
        return [

            'id'=>$this->id,
            'title'=>$this->title,
            'image'=>$this->image,
            'file'=>$this->file,
            // 'doctor_id'=>$this->doctor_id,
            'doctor'=>new DoctorResource($this->doctor),

        ];
>>>>>>> 0d40d51a2bfd20aaf60acc0a251877342c6779ea
    }
}
