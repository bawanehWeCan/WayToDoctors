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
            'question'=>$this->question->question,
            'answer_id'=>(int)$this?->answerRelation?->id,
            'answer'=>$this?->answer,
            'is_correct'=>(int)$this?->answerRelation?->correct
        ];
    }
}
