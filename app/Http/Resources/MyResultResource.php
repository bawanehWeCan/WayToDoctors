<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class MyResultResource extends JsonResource
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
            'results'=>ResultResource::collection($this->results),
        ];
    }
}

// <?php

// namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\JsonResource;

// class MyResultResource extends JsonResource
// {
//     /**
//      * Transform the resource into an array.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
//      */
//     public function toArray($request)
//     {
//         return [

//             // 'question'=>QuestionResource::make($this->question),

//

//             'section'=>$this->question->section->name,
//             'question'=>$this->question->question,

//             // 'answers'=>AnswerResource::collection($this->question->answers)->where('correct',1)->pluck('answer'),
//             // 'answers'=>AnswerResource::collection($this->question->answers)->where('id',$this->answer_id)->pluck('answer'),
//             'answers'=>$this->answer->answer,
//             'is_correct'=>$this->answer->correct,
//             // 'is_correct'=>AnswerResource::collection($this->question->answers)->where('id',$this->answer_id)->pluck('correct'),

//         ];
//     }
// }
