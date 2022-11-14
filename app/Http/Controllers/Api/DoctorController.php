<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DoctorController extends ApiController
{
    public function __construct()
    {
        $this->resource = DoctorResource::class;
        $this->model = app(Doctor::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function lookfor(Request $request){

        return $this->search('name',$request->value);

    }



}
