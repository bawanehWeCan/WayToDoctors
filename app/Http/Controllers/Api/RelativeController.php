<?php

namespace App\Http\Controllers\Api;

use App\Models\Relative;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\RelativeRequest;
use App\Http\Resources\RelativeResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class RelativeController extends ApiController
{
    public function __construct()
    {
        $this->resource = RelativeResource::class;
        $this->model = app(Relative::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
