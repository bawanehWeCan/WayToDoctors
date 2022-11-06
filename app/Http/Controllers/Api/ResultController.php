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

        return $this->store( $request->all() );

    }

    public function updateResult( ResultRequest $request,$id){
        return $this->update($request->all(),$id );

    }
}
