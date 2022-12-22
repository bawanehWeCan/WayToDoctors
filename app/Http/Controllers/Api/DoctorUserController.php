<?php

namespace App\Http\Controllers\Api;

use App\Models\User_Doctor;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\DoctorUserResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DoctorUserController extends ApiController
{
    public function __construct()
    {
        $this->resource = DoctorUserResource::class;
        $this->model = app(User_Doctor::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
