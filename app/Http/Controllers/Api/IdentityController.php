<?php

namespace App\Http\Controllers\Api;

use App\Models\Identity;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\IdentityRequest;
use App\Http\Resources\IdentityResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class IdentityController extends ApiController
{
    public function __construct()
    {
        $this->resource = IdentityResource::class;
        $this->model = app(Identity::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
