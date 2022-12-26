<?php

namespace App\Http\Controllers\Api;

use App\Models\User_Doctor;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\DoctorUserResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

use Auth;

class DoctorUserController extends ApiController
{
    public function __construct()
    {
        $this->resource = DoctorUserResource::class;
        $this->model = app(User_Doctor::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        $model = User_doctor::where('doctor_id',$request->doctor_id)->where('user_id',$request->user_id)->first();

        if($model){
            return $this->returnError(__('Sorry! Doctor already exist !'));
        }
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function deletebyID( $doctor_id, $user_id ){


        $model = User_doctor::where('doctor_id',$doctor_id)->where('user_id',$user_id)->first();

        if (!$model) {
            return $this->returnError(__('Sorry! Failed to get !'));
        }

        $model->delete();



        return $this->returnSuccessMessage(__('Delete succesfully!'));


    }
}
