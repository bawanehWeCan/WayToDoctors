<?php

namespace App\Http\Controllers\Api;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Http\Resources\ResultResource;
use App\Http\Controllers\ApiController;
use App\Models\Answer;
use App\Models\User;

class ResultController extends ApiController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->resource = ResultResource::class;
        $this->model = app(Result::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( ResultRequest $request ){
        if($this->checkQuestion($request)){
            return $this->store( $request->all() );
        }else{
            return $this->returnError(__("Sorry This Answer is not allowed for this question"));
        }

    }

    public function updateResult( ResultRequest $request,$id){
        if($this->checkQuestion($request)){
            return $this->update($request->all(),$id );
        }else{
            return $this->returnError(__("Sorry This Answer is not allowed for this question"));
        }

    }

    public function checkQuestion($request)
    {
        $user = User::find($request->user_id);
        $userResult = Result::where('question_id',$request->question_id)->whereBelongsTo($user)->first();
        $questionId = Answer::find($request->answer_id)->question->id;
        if(!empty($request->answer_id)){
                return $request->question_id == $questionId && empty($userResult);
        }
    }
}
