<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BlogController extends ApiController
{

    public function __construct()
    {
        $this->resource = BlogResource::class;
        $this->model = app(Blog::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
