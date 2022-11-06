<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\Repository;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->resource = UserResource::class;
        $this->model = app(User::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( UserRequest $request ){
        return $this->store( $request->all() );
    }

}
