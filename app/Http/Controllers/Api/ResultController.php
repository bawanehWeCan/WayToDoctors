<?php

namespace App\Http\Controllers\Api;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Http\Resources\ResultResource;
use App\Http\Resources\MyResultResource;
use App\Http\Resources\SectionResource;
use App\Http\Controllers\ApiController;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\Section;
use Auth;

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
        $question = Question::find($request->question_id);
        if (!$question) {
            return $this->returnError(__("Sorry question is not exist"));
        }
        if($this->checkQuestion($request)){
            $request['user_id'] = Auth::user()->id;
            $request['section_id'] = $question->section->id;
            $user=Auth::user();

            //dd( $user );
            //$user->step=$request->step_id;
            $user->step=$question->section->id;
            $user->question_number=$question->id;
            $user->save();

            $q = Question::where('condition',$request->answer_id)->first();
            if( $q ){
                $arr = array();
                $r = new Result();
                $r->question_id = $request->question_id;
                $r->answer_id = $request->answer_id;
                $r->user_id = Auth::user()->id;
                $r->save();

                $arr['result'] = $r;
                $arr['section_id'] = $question->section->id;
                $arr['question'] = $q;

                dd($arr);

                return;



            }
            return $this->store( $request->all() );




        }else{
            return $this->returnError(__("Sorry This Answer is not allowed for this question"));
        }

    }

    public function edit($id, ResultRequest $request){
        $question = Question::find($request->question_id);
        if (!$question) {
            return $this->returnError(__("Sorry question is not exist"));
        }
        if($this->checkQuestion($request)){
            return $this->update($id,$request->all() );
        }else{
            return $this->returnError(__("Sorry This Answer is not allowed for this question"));
        }

    }

    public function checkQuestion($request)
    {

        $userResult = $this->model->where('question_id',$request->question_id)->where('user_id', Auth::user()->id)->first();

        return empty($userResult);

    }


    public function myResult(ResultRequest $request){

        //$data = $this->model->where('user_id', Auth::user()->id)->get();
        $data = Section::all();
        return $this->returnData('data',  MyResultResource::collection( $data ), __('Get  succesfully'));
    }
}
