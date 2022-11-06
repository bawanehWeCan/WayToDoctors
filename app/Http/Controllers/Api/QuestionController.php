<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\QuestionResource;

class QuestionController extends ApiController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->resource = QuestionResource::class;
        $this->model = app(Question::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( QuestionRequest $request ){

        return $this->store( $request->all() );

    }

    public function updateQuestion( QuestionRequest $request,$id){
        return $this->update($request->all(),$id );

    }
}
