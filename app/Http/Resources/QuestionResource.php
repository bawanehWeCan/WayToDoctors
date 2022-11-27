<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\Result;
use App\Models\Answer;

class QuestionResource extends JsonResource
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
            'section_id'=>$this->section_id,
            'question'=>$this->question,
            'condition'=>$this->condition,
            //'current_answer' => Answer::find( Result::current( $this->id )->first()->answer_id ),
            //'current_answer' =>!empty( Result::current( $this->id )->whereBelongsTo( Auth::user() )->first()->answer_id ) ? Result::current( $this->id )->whereBelongsTo( Auth::user() )->first()->answer->answer : 'aaa',
            'answers'=>AnswerResource::collection($this->answers),
        ];
    }
}
