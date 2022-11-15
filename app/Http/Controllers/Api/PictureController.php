<?php

namespace App\Http\Controllers\Api;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PictureRequest;
use App\Http\Resources\PictureResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PictureController extends ApiController
{
    public function __construct()
    {
        $this->resource = PictureResource::class;
        $this->model = app(Picture::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
