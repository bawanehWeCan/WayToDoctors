<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\Favorite;

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
        $fav = false;
        // احنا غلط نكتب لوجيك بالريسورس بس هاي حالة شاذه ما رح تاثر بتم
        if(Auth::user()){
        $favorite = Favorite::where('user_id',Auth::user()->id)->where('doctor_id',$this->id)->first();
            if($favorite){
                $fav = true ;
            }
    }
        return [

            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->image,
            'address'=>(string)$this->address,
            'category_id'=>1,
            'category_name'=>'test',
            'user_count'=>500,
            'is_favorite'=>$fav,        // 'rating'=>4.5,
            'rating'=>(double)$this?->reviews->avg('points'),
            'experience'=>$this->experience,
            'description'=>(string)$this->description,
            'phone'=>$this->phone,
            'lat'=>$this->lat,
            'long'=>$this->long,
             'clinic_id'=>$this->clinic_id,
           //'clinic'=>new ClinicResource($this?->clinic),
            'certificates'=> CertificateResource::collection($this?->certificates),
            'studies'=> StudyResource::collection($this?->studies),
            'pictures'=> PictureResource::collection($this?->pictures),

        ];


    }
}
