<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Controllers\ApiController;

class AnswerController extends ApiController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->resource = AnswerResource::class;
        $this->model = app(Answer::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( AnswerRequest $request ){

        return $this->store( $request->all() );

    }

    public function edit( $id,AnswerRequest $request){
        return $this->update($id,$request->all() );

    }
}
