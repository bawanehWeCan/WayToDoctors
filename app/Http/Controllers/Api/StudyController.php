<?php

namespace App\Http\Controllers\Api;

use App\Models\Study;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\StudyRequest;
use App\Http\Resources\StudyResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class StudyController extends ApiController
{
    public function __construct()
    {
        $this->resource = StudyResource::class;
        $this->model = app(Study::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
