<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'question'=>[
                'id'=>$this->question->id,
                'question'=>$this->question->question,
                'section'=>$this->question->section->name,
                'condition'=>$this->question->condition,
                'result'=>$this->result,
                'answer'=>[
                    'id'=>$this->answer->id,
                    'question'=>$this->answer->answer,
                    'question_id'=>$this->answer->question_id,
                    'correct'=>$this->answer->correct,
                ]
            ],
            'user'=>new UserResource($this->user),
        ];
    }
}
