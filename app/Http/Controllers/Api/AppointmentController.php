<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AppointmentController extends ApiController
{

    public function __construct()
    {
        $this->resource = AppointmentResource::class;
        $this->model = app(Appointment::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function nextAppointmentList(){

        return $this->listWithCondition('type','next');
    }

    public function finishedAppointmentList(){

        return $this->listWithCondition('type','finished');
    }

    public function canceledAppointmentList(){

        return $this->listWithCondition('type','canceled');
    }

}
