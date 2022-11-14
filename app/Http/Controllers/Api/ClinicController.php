<?php

namespace App\Http\Controllers\Api;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;


class ClinicController extends ApiController
{
    public function __construct()
    {
        $this->resource = ClinicResource::class;
        $this->model = app(Clinic::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
