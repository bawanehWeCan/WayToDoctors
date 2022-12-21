<?php

namespace App\Http\Controllers\Api;

use App\Models\File;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\FileRequest;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class FileController extends ApiController
{
    public function __construct()
    {
        $this->resource = FileResource::class;
        $this->model = app(File::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
